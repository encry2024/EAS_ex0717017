<?php

namespace App\Listeners\Backend\Management\Costing\Project;

/**
* Class ProjectEventListener.
*/
class ProjectEventListener
{
   /**
   * @var string
   */
   private $history_slug = 'Project';

   /**
   * @param $event
   */
   public function onCreated($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->project->id)
      ->withText('trans("history.backend.projects.created") <strong>{project}</strong>')
      ->withIcon('plus')
      ->withClass('bg-green')
      ->withAssets([
         'project_link' => ['admin.management.costing.project.show', $event->project->name, $event->project->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onUpdated($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->project->id)
      ->withText('trans("history.backend.projects.updated") <strong>{project}</strong>')
      ->withIcon('save')
      ->withClass('bg-aqua')
      ->withAssets([
         'project_link' => ['admin.management.costing.project.show', $event->project->name, $event->project->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onDeleted($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->project->id)
      ->withText('trans("history.backend.projects.deleted") <strong>{project}</strong>')
      ->withIcon('trash')
      ->withClass('bg-maroon')
      ->withAssets([
         'project_link' => ['admin.management.costing.project.show', $event->project->name, $event->project->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onRestored($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->project->id)
      ->withText('trans("history.backend.projects.restored") <strong>{project}</strong>')
      ->withIcon('refresh')
      ->withClass('bg-aqua')
      ->withAssets([
         'project_link' => ['admin.management.costing.project.show', $event->project->name, $event->project->id],
      ])
      ->log();
   }

   /**
   * @param $event
   */
   public function onPermanentlyDeleted($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->project->id)
      ->withText('trans("history.backend.projects.permanently_deleted") <strong>{project}</strong>')
      ->withIcon('trash')
      ->withClass('bg-maroon')
      ->withAssets([
         'project_string' => $event->project->name,
      ])
      ->log();

      history()->withType($this->history_slug)
      ->withEntity($event->project->id)
      ->withAssets([
         'project_string' => $event->project->name,
      ])
      ->updateUserLinkAssets();
   }

   /**
   * @param $event
   */
   public function onUploaded($event)
   {
      history()->withType($this->history_slug)
      ->withEntity($event->project->id)
      ->withText('trans("history.backend.management.costing.project.uploaded") <strong>{project}</strong>')
      ->withIcon('upload')
      ->withClass('bg-aqua')
      ->withAssets([
         'project_link' => ['admin.management.costing.project.show', $event->project->name, $event->project->id],
      ])
      ->log();
   }

   /**
   * Register the listeners for the subscriber.
   *
   * @param \Illuminate\Events\Dispatcher $events
   */
   public function subscribe($events)
   {
      $events->listen(
         \App\Events\Backend\Management\Costing\Project\ProjectCreated::class,
         'App\Listeners\Backend\Management\Costing\Project\ProjectEventListener@onCreated'
      );

      $events->listen(
         \App\Events\Backend\Management\Costing\Project\ProjectUpdated::class,
         'App\Listeners\Backend\Management\Costing\Project\ProjectEventListener@onUpdated'
      );

      $events->listen(
         \App\Events\Backend\Management\Costing\Project\ProjectDeleted::class,
         'App\Listeners\Backend\Management\Costing\Project\ProjectEventListener@onDeleted'
      );

      $events->listen(
         \App\Events\Backend\Management\Costing\Project\ProjectRestored::class,
         'App\Listeners\Backend\Management\Costing\Project\ProjectEventListener@onRestored'
      );

      $events->listen(
         \App\Events\Backend\Management\Costing\Project\ProjectPermanentlyDeleted::class,
         'App\Listeners\Backend\Management\Costing\Project\ProjectEventListener@onPermanentlyDeleted'
      );

      $events->listen(
         \App\Events\Backend\Management\Costing\Project\ProjectUploaded::class,
         'App\Listeners\Backend\Management\Costing\Project\ProjectEventListener@onUploaded'
      );
   }
}
