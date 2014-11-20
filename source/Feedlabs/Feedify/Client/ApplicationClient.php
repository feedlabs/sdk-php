<?php

namespace Feedlabs\Feedify\Client;

use Feedlabs\Feedify\Params;
use Feedlabs\Feedify\Resource\Application;
use Feedlabs\Feedify\Resource\ApplicationList;

/**
 * Class ApplicationClient
 * @package Feedlabs\Feedify\Client
 */
class ApplicationClient {

    /**
     * @return ApplicationList
     */
    public function getList() {
        // todo: load over API

        $applicationList = [];
        for ($i = 0; $i < 5; $i++) {
            $applicationList[] = [
                'id'          => 'id' . $i,
                'name'        => 'Name-' . $i,
                'createStamp' => time(),
            ];
        }

        return new ApplicationList($applicationList);
    }

    /**
     * @param string $applicationId
     * @return Application
     */
    public function get($applicationId) {
        $applicationId = (string) $applicationId;

        // todo: load over API

        $data = new Params([
            'id'          => $applicationId,
            'name'        => 'Name-' . $applicationId,
            'description' => 'description' . $applicationId,
            'createStamp' => time(),
        ]);
        return new Application($data);
    }

    /**
     * @param string      $name
     * @param string|null $description
     * @return Application
     */
    public function create($name, $description = null) {
        $name = (string) $name;
        $description = (string) $description;

        // todo: send / load over API

        $data = new Params([
            'id'          => 'ABC123',
            'name'        => 'Name-ABC123',
            'description' => 'description-ABC123',
            'createStamp' => time(),
        ]);
        return new Application($data);
    }

    /**
     * @param string      $applicationId
     * @param string      $name
     * @param string|null $description
     * @return Application
     */
    public function update($applicationId, $name, $description = null) {
        $applicationId = (string) $applicationId;
        $name = (string) $name;
        $description = (string) $description;

        // todo: send / load over API

        $data = new Params([
            'id'          => $applicationId,
            'name'        => 'Name-' . $applicationId,
            'description' => 'description' . $applicationId,
            'createStamp' => time(),
        ]);
        return new Application($data);
    }

    /**
     * @param string $applicationId
     */
    public function delete($applicationId) {
        $applicationId = (string) $applicationId;

        // todo: send / load over API
        // todo: think about what to return
    }
}
