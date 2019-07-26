<?php

namespace App\Models;

use App\Extensions\Lookup;
use Illuminate\Database\Eloquent\Model;

class Scripts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scripts';

  /**
     * @var array
     */
    public $appends = ['script_lines', 'spoken_words_per_actor', 'character_mentions'];

    public function movie(){
        return $this->hasOne('App\Models\Movies', 'id', 'movie_id');
    }

    public function lines(){
        return $this->hasMany('App\Models\ScriptLines', 'script_id', 'id');
    }

    public function getScriptLinesAttribute()
    {
        return ScriptLines::where('script_id',$this->id)->count();
    }

    public function getSpokenWordsPerActorAttribute()
    {
        // get all character assigned to movie
        $actorsInMovie = ActorsMovies::where('movie_id', $this->movie_id)->get();
        $actorNamesDictionary = [];
        // get all script lines
        $lines = ScriptLines::where('script_id',$this->id)->get();
        $countPerActor = [];
        foreach ($actorsInMovie as $actorInMovie){
            // initialize count per actor with 0
            $countPerActor[$actorInMovie->id] = 0;
            // add actor in movie to dictionary for a quick mapping ActorID to ActorName
            $actorNamesDictionary[$actorInMovie->id] = Actors::find($actorInMovie->actor_id)->actor_name;
        }
        // iterate through lines
        foreach ($lines as $line){
            $countPerActor[$line->actor_id] = $countPerActor[$line->actor_id] + str_word_count($line->line);
        }
        $spokenWordsPerActor = [];
        // remap the count per actor from actorId -> count to actorName -> count
        foreach ($countPerActor as $actor_id => $count){
            $spokenWordsPerActor[$actorNamesDictionary[$actor_id]] = $count;
        }
        return $spokenWordsPerActor;
    }

    public function getCharacterMentionsAttribute()
    {
        // get all characters in movie
        $charactersInMovie = ActorsMovies::where('movie_id', $this->movie_id)->get();
        $countPerCharacter = [];
        // iterate through each character
        foreach ($charactersInMovie as $characterInMovie){
            // initialize this character mentions with 0
            $countPerCharacter[$characterInMovie->movie_character_name] = 0;
            // get all script lines spoken by other characters, we should not count the lines by the character we are evaluating
            $linesByOtherCharacters = ScriptLines::where('script_id',$this->id)->where('actor_id','!=',$characterInMovie->id)->get();
            // iterate through each line
            foreach ($linesByOtherCharacters as $line){
                // perform lookup
                $lookup = new Lookup($line->line, $characterInMovie->movie_character_name);
                $lookup->find();
                // add previous character mentions with new matches
                $countPerCharacter[$characterInMovie->movie_character_name] = $countPerCharacter[$characterInMovie->movie_character_name] + $lookup->matches;
            }
        }
        return $countPerCharacter;
    }

}
