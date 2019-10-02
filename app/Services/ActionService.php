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

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

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
        $this->response['action'] = $this->getModel(Action::class, $this->actionData());
        $this->response['actionHub'] = ActionHub::firstOrCreate($this->actionHubData());
        $this->response['actors'] = [];
        foreach ($this->data['names'] as $name) {
            $this->name = trim($name);
            $this->response['actors'][] = $this->getModel(Actor::class, $this->actorData());
            // TODO: actorHub
        }
    }

    private function actionData(): array
    {
        return [
            'name' => ['en' => $this->type],
        ];
    }

    private function actorData(): array
    {
        return [
            'name' => ['en' => $this->name],
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

    private function getModel(string $class, array $data)
    {
        $className = $this->getClassName($class);
        $objModel = $class::where('name->en', $this->$className['en'])->first();
        if ($objModel instanceof $class)
            return $objModel;
        return $class::Create($data);
    }

    private function getClassName(string $class)
    {
        $parts = explode('/', $class);
        return end($parts);
    }

}
