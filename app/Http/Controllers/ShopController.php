<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Record;


use Facades\App\Helpers\Json;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {


        $genre_id = $request->input('genre_id') ?? '%'; //OR $genre_id = $request->genre_id ?? '%';
        $artist_title = '%' . $request->input('artist') . '%'; //OR $artist_title = '%' . $request->artist . '%';
        $records = Record::with('genre')
            ->where(function ($query) use ($artist_title, $genre_id) {
                $query->where('artist', 'like', $artist_title)
                    ->where('genre_id', 'like', $genre_id);

            })
            ->orWhere(function ($query) use ($artist_title, $genre_id) {
                $query->where('title', 'like', $artist_title)
                    ->where('genre_id', 'like', $genre_id);
            })
            ->orderby('artist')
            ->paginate(12)
            ->appends(['artist'=> $request->input('artist'), 'genre_id' => $request->input('genre_id')]);

        foreach ($records as $record) {
            $record->cover = $record->cover ?? "https://coverartarchive.org/release/$record->title_mbid/front-250.jpg";
        }
        $genres = Genre::orderBy('name')
            ->has('records')
            ->withCount('records')
            ->get()
            ->transform(function ($item, $key) {
                // Set first letter of name to uppercase and add the counter
                $item->name = ucfirst($item->name) . ' (' . $item->records_count . ')';
                // Remove all fields that you don't use inside the view
                unset($item->created_at, $item->updated_at, $item->records_count);
                return $item;
            });


        //get id to name
        $genresName = Genre::where("id", $request->input('genre_id'))
            ->get()
            ->transform(function ($item, $key) {
                // Set first letter of name to uppercase and add the counter
                $item->name = ucfirst($item->name);
                // Remove all fields that you don't use inside the view
                unset($item->created_at, $item->updated_at, $item->records_count);
                return $item;
            });
        if($genresName->isNotEmpty()){
            $genresName = $genresName->first()->name;
        }else{
            $genresName = false;
        }


        //dd($records);

        //dump($result);                    // open http://vinyl_shop.test/shop?json

        $result = compact('genres','records','genresName');
        //return ['$result' => $result];
        //Json::dump($result);

        return view('shop.index', $result);
    }

    public function show($id)
    {
        $record = Record::with('genre')->findOrFail($id);
// dd($record);
// Real path to cover image
        $record->cover = $record->cover ?? "https://coverartarchive.org/release/$record->title_mbid/front-250.jpg";
// Combine artist + title
        $record->title = $record->artist . ' - ' . $record->title;
// Links to MusicBrainz API (used by jQuery)
// https://wiki.musicbrainz.org/Development/JSON_Web_Service
        $record->artistUrl = 'https://musicbrainz.org/ws/2/artist/' . $record->artist_mbid . '?inc=url-rels&fmt=json';
        $record->recordUrl = 'https://musicbrainz.org/ws/2/release/' . $record->title_mbid . '?inc=recordings+url-rels&fmt=json';
// If stock > 0: button is green, otherwise the button is red
        $record->btnClass = $record->stock > 0 ? 'btn-outline-success' : 'btn-outline-danger';
// You can't overwrite the attribute genre (object) with a string, so we make a new attribute
        $record->genreName = $record->genre->name;
// Remove attributes you don't need for the view
        unset($record->genre_id, $record->artist, $record->created_at, $record->updated_at, $record->artist_mbid, $record->title_mbid, $record->genre);
        $result = compact('record');
        //return ['$result' => $result];
        //Json::dump($result);
        return view('shop.show', $result);  // Pass $result to the view
    }

    public function shop_alt()
    {
        $genres = Genre::with('records')
            ->has('records')
            ->orderBy('name')
            ->get()
            ->transform(function ($item, $key) {
                unset($item->id,$item->created_at,$item->updated_at);
                return $item;
            });

        //return ['genres' => $genres];
        $result = compact('genres');
        return view('shop.shop_alt', $result);
    }



}
