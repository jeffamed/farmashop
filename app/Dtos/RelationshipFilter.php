<?php

namespace App\Dtos;

class RelationshipFilter
{
     public function __construct(
      public string $modelRelation,
      public string $search,
      public string $column = 'name'
     ){}
}
