<?php

namespace App\Models;

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
        $lines = ScriptLines::with('movieActor.actor')->where('script_id',$this->id)->get();
        $countPerActor = [];
//        foreach ($lines as $line){
//            if(!isset($countPerActor[$line->movie_actor->actor->actor_name])){
//              $countPerActor[$line->movie_actor->actor->actor_name] = 0;
//            }
//            $countPerActor[$line->movie_actor->actor->actor_name] = $countPerActor[$line->movie_actor->actor->actor_name] + str_word_count($line->line);
//        }
        return $countPerActor;
    }

    public function getCharacterMentionsAttribute()
    {
        $lines = ScriptLines::with('movieActor')->where('script_id',$this->id)->get();

        $characterMentions = [];
        $characters = [];
        $characterDictionary = [];

        foreach ($lines as $line){
            if(!isset($characterMentions[$line->movie_actor->movie_character_name])){
              $characterMentions[$line->movie_actor->movie_character_name] = 0;
            }
            if(!in_array($line->movie_actor->movie_character_name, $characters)){
                $characters[] = $line->movie_actor->movie_character_name;
            }
        }

        foreach ($characters as $character){
            $characterDictionary[$character] = explode(' ',$character);
        }

        foreach ($lines as $line){
//            foreach ($characters as $character){
//                if($line->movie_actor->movie_character_name == $character){
//                    continue;
//                }
//                $possibleNames = $characterDictionary[$character];
//                foreach ($possibleNames as $possibleName){
//                    $characterMentions[$character] = $characterMentions[$character] + substr_count($line->line, $possibleName);
//                }
//            }
        }
        return $characterMentions;
    }

}
