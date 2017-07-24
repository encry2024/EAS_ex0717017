<?php

namespace App\Events\Backend\Management\Costing\Project;

use Illuminate\Queue\SerializesModels;

/**
* Class ProjectPermanentlyDeleted.
*/
class ProjectPermanentlyDeleted
{
   use SerializesModels;

   /**
   * @var
   */
   public $project;

   /**
   * @param $project
   */
   public function __construct($project)
   {
      $this->project = $project;
   }
}
