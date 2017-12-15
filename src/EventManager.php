<?php

namespace engldom;

use engldom\Model\Events;

/**
 * Class EventManager
 * @package engldom
 */
class EventManager
{
    public static $instance = null;

    private $listeners = array();

    /**
     *
     * @return EventManager
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    /**
     * @param string $eventName
     * @param array $data
     * @return EventManager
     */
    public function emit($eventName, array $data = array())
    {
        $listener = $this->getListener($eventName);
        if (!$listener) {
            return $this;
        }

        foreach ($listener as $event) {
            call_user_func($event['callback'], $data);
        }
        return $this;
    }

    /**
     *
     * @param string $eventName
     * @param mixed $callback
     * @return EventManager
     */
    public function on($eventName, $callback)
    {
        return $this->registerEvent($eventName, $callback);
    }

    /**
     *
     */
    public function initEvents()
    {
        $eventModel = new Events();
        $events = $eventModel->findAll();

        foreach ($events as $eventsKey => $eventsValue) {
            $this->registerEvent($eventsValue['name'], $eventsValue['class_name'] . '::' . $eventsValue['method']);
        }
    }

    /**
     *
     * @param string $eventName
     * @return EventManager
     */
    public function detach(string $eventName)
    {
        return $this->removeRegisterEvent($eventName);
    }

    /**
     *
     * @param string $eventName
     * @param mixed $callback
     * @return EventManager
     */
    public function registerEvent(string $eventName, $callback)
    {
        $eventName = trim($eventName);
        if (!isset($this->listeners[$eventName])) {
            $this->listeners[$eventName] = array();
        }
        $event = array(
            'event_name' => $eventName,
            'callback' => $callback
        );
        array_push($this->listeners[$eventName], $event);
        if (count($this->listeners[$eventName]) > 1) {
            usort($this->listeners[$eventName]);
        }
        return $this;
    }

    /**
     *
     * @param string $eventName
     * @return EventManager
     */
    public function removeRegisterEvent(string $eventName)
    {
        if (isset($this->listeners[$eventName])) {
            unset($this->listeners[$eventName]);
        }
        return $this;
    }

    /**
     *
     * @return array
     */
    public function getListeners()
    {
        return $this->listeners;
    }

    /**
     * @param $listener
     * @return bool | array
     */
    public function getListener(string $listener)
    {
        if (isset($this->listeners[$listener])) {
            return $this->listeners[$listener];
        }
        return false;
    }
}
