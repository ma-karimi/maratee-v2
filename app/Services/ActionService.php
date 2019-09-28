<?php


namespace App\Services;


use App\Models\Action;
use App\Models\ActionHub;
use App\Models\Actor;
use App\Models\Location;

class ActionService
{

    private $whiteList = Action::TYPES;

    private $data = [];
    private $response = [];


    public static function __callStatic($name, $arguments)
    {
        $service = new self();
        if (!$service->inWhiteList($name))
            return null;
        $service->data = $arguments[0];
        $service->data['type'] = $name;
        $service->action();
        return $service->response;
    }

    private function inWhiteList(string $name): bool
    {
        return in_array($name, $this->whiteList);
    }

    private function action()
    {
        $this->response['action'] = Action::firstOrCreate($this->actionData());
        $this->response['actionHub'] = ActionHub::firstOrCreate($this->actionHubData());
        $this->response['actors'] = [];
        foreach ($this->data['names'] as $name) {
            $name = trim($name);
            $name = ['en' => $name, 'fa' => $name, 'es' => $name];
            $this->response['actors'][] = Actor::firstOrCreate(compact('name'));
            // TODO: actorHub
        }
    }

    private function actionData(): array
    {
        return [
            'name' => ['en' => $this->data['type']],
        ];
    }

    private function actionHubData(): array
    {
        return [
            'action_id' => $this->response['action']->id,
            'actionable_type' => Location::class,
            'actionable_id' => $this->data['location_id'],
            'date' => $this->data['date'],
        ];
    }

}
