<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ScriptLines;

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
        $lines = ScriptLines::where('script_id',$this->id)->get();
        $countPerActor = [];
        foreach ($lines as $line){
            if(!isset($countPerActor[$line->actor_id])){
              $countPerActor[$line->actor_id] = 0;
            }
            $countPerActor[$line->actor_id] = str_word_count($line->line);
        }
        return $countPerActor;
    }
    
    public function getCharacterMentionsAttribute()
    {
        $lines = ScriptLines::with('movieActor')->where('script_id',$this->id)->get();
        $characterMentions = [];
        foreach ($lines as $line){
            if(!isset($characterMentions[$line->movie_actor->movie_character_name])){
              $characterMentions[$line->movie_actor->movie_character_name] = 0;
            }
        }
        foreach ($lines as $line){
          foreach ($characterMentions as $character => $count){
            $characterMentions[$character] = $count + substr_count($line->line,$character);
          }
        }
        return $characterMentions;
    }
  
}
