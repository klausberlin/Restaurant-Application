<?php
/**
 * User: 'Alice Doe'
 * Date: 31.03.2017
 * Time: 22:53
 */

namespace Application\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;

class UserModel implements UserInterface
{
    private $_dbConnection;
    private $_table;

    public function __construct(AdapterInterface $dbconn)
    {
        $this->_dbConnection = $dbconn;
        $this->_table = new Sql($this->_dbConnection, 'users');
    }

    public function getUserByName($username)
    {
        $select = $this->_table->select();
        $select->where(["name" => $username]);

        $stmt = $this->_table->prepareStatementForSqlObject($select);
        $result = $stmt->execute();
        return $result;
    }
    public function getJson()
    {

        $json = array(
            'type' => 'dataaccesslevels',
            'accesslevels' =>
                [
                    [
                        'id' => 1,
                        'level' => 'cross',
                        'levelname' => 'Kreuz',
                        'levelsymbol' => 'fa fa-cross',
                        'activities' =>
                            [
                                [
                                    'id' => 8,
                                    'activitytype' => 'presence',
                                    'activitytypename' => 'Anwesenheit',
                                    'requests' =>
                                        [
                                            [
                                                'requestaccess' => 'allowed',
                                                'requester' =>
                                                    [
                                                        'id' => 17,
                                                        'organization' => 'escos',
                                                        'organizationname' => 'escos automation',
                                                    ],

                                            ],
                                            [
                                                'requester' =>
                                                    [
                                                        'id' => 18,
                                                        'organization' => 'RWE',
                                                        'organizationname' => 'RWE Smart Home Division'
                                                    ],
                                                'requestaccess' => 'denied',
                                            ],
                                            [
                                                'requester' =>
                                                    [
                                                        'id' => 19,
                                                        'organization' => 'Martin',
                                                        'organizationname' => 'Martin Elektrotechnik'
                                                    ],
                                                'requestaccess' => 'denied',
                                            ],
                                        ],
                                ],

                            ]
                    ]
                ]

        );
        return $json;
    }
}