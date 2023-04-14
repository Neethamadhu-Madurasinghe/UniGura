<?php
namespace MyApp;

use Ratchet\App;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    protected $routes;
    protected $online_users;

    public function __construct()
    {
        $this->routes = array();
        $this->online_users = array();
    }



    public function onOpen(ConnectionInterface $conn)
    {
        $route = $conn->route;
        if (!isset($this->routes[$route])) {
            $this->routes[$route] = array(
                'connections' => new \SplObjectStorage,
                'clients' => 0,
            );
        }

        echo "New connection! ({$conn->resourceId}) in route $route \n";



        $this->routes[$route]['connections']->attach($conn);
        $this->routes[$route]['clients']++;
    }



    public function onClose(ConnectionInterface $conn)
    {
        $route = $conn->route;
        $this->routes[$route]['connections']->detach($conn);
        $this->routes[$route]['clients']--;
        echo "Connection {$conn->resourceId} has disconnected from route $route \n";

        if ($this->routes[$route]['clients'] == 0) {

            unset($this->routes[$route]);
            echo "Route $route has been deleted\n";
        }
        echo "open routes are " . count($this->routes) . "\n";
        // list all open routes
        foreach ($this->routes as $key => $value) {
            echo "route: $key \n";
        }

//        Remove user from the online list
        unset($this->online_users[$conn->resourceId]);
        print_r($this->online_users);

//        Send everyone online user list
        foreach ($this->routes as $route) {
            foreach ($route['connections'] as $client) {
                $client->send(json_encode([
                    'online_users' => $this->online_users
                ]));
            }
        }

    }



    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg);
        print_r($data);
        if (isset($data->newRoute)) {
            $newRoute = $data->newRoute;
            if (!isset($this->routes[$newRoute])) {
                $this->routes[$newRoute] = array(
                    'connections' => new \SplObjectStorage,
                    'clients' => 0,
                );
                echo "New route: $newRoute\n";
            }
            $from->route = $newRoute;
            $this->routes[$newRoute]['connections']->attach($from);
            $this->routes[$newRoute]['clients']++;

//            Only add the user into online users list if he's not already there
            $isAdd = false;
            foreach ($this->online_users as $key => $value) {
                if ($value === $data->id) {
                    $isAdd = true;
                }
            }

            if (!$isAdd) {
                $this->online_users[$from->resourceId] = $data->id;
                echo "User with id " . $data->id . " has been added to the online users list";
//                Tell everyone who is online right now

                foreach ($this->routes as $route) {
                    foreach ($route['connections'] as $client) {
                        $client->send(json_encode([
                            'online_users' => $this->online_users
                        ]));
                    }
                }

            }

            print_r($this->online_users);
            echo "Connection {$from->resourceId} has connected to route $newRoute \n";

        } elseif (isset($data->typing)) {
            $route = $from->route;
            $numRecv = count($this->routes[$route]['connections']) - 1;
            echo sprintf(
                'Connection %d is typing in %s route' . "\n"
                , $from->resourceId,
                $route
            );

            foreach ($this->routes[$route]['connections'] as $client) {
                if ($from !== $client) {
                    // The sender is not the receiver, send to each client connected 
                    $client->send(json_encode([
                        'typing' => 'y',
                        'name' => $data->name
                    ]));
                }
            }
        } elseif (isset($data->request_online_users)) {
            $route = $from->route;
            foreach ($this->routes[$route]['connections'] as $client) {
                if ($from !== $client) {
                    $client->send(json_encode([
                        'online_users' => $this->online_users
                    ]));
                }
            }

        } else {
            $route = $from->route;
            $numRecv = count($this->routes[$route]['connections']) - 1;
            echo sprintf(
                'Connection %d sending message "%s" to %d other connection%s through %s route' . "\n"
                , $from->resourceId,
                $msg,
                $numRecv, $numRecv == 1 ? '' : 's',
                $route
            );

            foreach ($this->routes[$route]['connections'] as $client) {
                if ($from !== $client) {
                    // The sender is not the receiver, send to each client connected 
                    $client->send(json_encode([
                        'name' => $data->name,
                        'date' => $data->date,
                        'msg' => $data->msg
                    ]));
                }
            }
        }
    }
 



    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
 