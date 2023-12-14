<?php 
namespace App\Repositories;

use App\Repositories\Contracts\EnglishRepositoryInterface;
use App\Models\English;

class EnglishRepository implements EnglishRepositoryInterface{

    protected $entity;

    public function __construct(English $english)
    {
        $this->entity = $english;
    }

    public function all(int $user_id){
        return $this->entity->where("user_id", $user_id)->orderBy('created_at', 'desc')->get();
    }
  
    public function byId(int $user_id, int $id){
        return $this->entity->where("user_id", $user_id)->where('id', $id)->first();
    }
  
    public function store(array $english_input)
    {
        return English::create($english_input);
    }

    public function update(object $english, array $english_input)
    {
        return $english->update($english_input);
    }
    
    public function destroy(object $english)
    {
        return $english->delete();
    }

}