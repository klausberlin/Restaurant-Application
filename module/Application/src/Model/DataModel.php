<?php
/**
 * User: Alice in wonderland
 * Date: 18.04.2017
 * Time: 21:32
 */

namespace Application\Model;



use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Sql;


class DataModel implements DataInterface
{

    private $_dbConnection;
    //Tables definition from database
    private $_items;
    private $_category;
    private $_tables;
    private $_users;
    private $_orders;
    private $_foodorders;

    //DI to connect the database
    public function __construct(AdapterInterface $dbconn)
    {
        //connect with database
        $this->_dbConnection = $dbconn;

        //get the tables
        $this->_items = new Sql($this->_dbConnection, 'items');
        $this->_category = new Sql($this->_dbConnection,'category');
        $this->_tables = new Sql($this->_dbConnection, 'tables');
        $this->_users = new Sql($this->_dbConnection, 'users');
        $this->_orders = new Sql($this->_dbConnection,'orders');
        $this->_foodorders = new Sql($this->_dbConnection,'foodorders');

    }
    //get all data from table 'items'
    public function getItems()
    {
        $select = $this->_items->select();
        $items = $this->_items->prepareStatementForSqlObject($select);
        $result = $items->execute();
        $resultSet = new ResultSet();
        $resultSet->initialize($result);
        $results = $resultSet->toArray();
        return $results;
    }
    //get all data from table 'categories'
    public function getCategories()
    {
        $select =  $this->_category->select();
        $category = $this->_category->prepareStatementForSqlObject($select);
        $return = $category->execute();
        //to loop through the value in the view I need to instantiate ResultSet
        $resultSet = new ResultSet();
        $resultSet->initialize($return);
        $return = $resultSet->toArray();
        return $return;
    }

    //test
    public function getjoins()
    {
        $select = $this->_category->select();
        $select->join(
            'items',
            'items.category=category.id'
        );
        $category = $this->_category->prepareStatementForSqlObject($select);
        $return = $category->execute();

        $resultSet = new ResultSet();
        $resultSet->initialize($return);
        $return = $resultSet->toArray();


        return $return;
    }
    //get a single item from table 'items'
    public function getSingleItem($id)
    {
        $select =  $this->_items->select();
        $select->where(["id" => $id]);
        $stmt = $this->_items->prepareStatementForSqlObject($select);
        $return = $stmt->execute();

        //to loop more the one time through the var
        $resultSet = new ResultSet();
        $resultSet->initialize($return);
        $return = $resultSet->toArray();

        return $return;
    }


    //get all data from table 'tables'
    public function getTables()
    {
        $select =  $this->_tables->select();
        $category = $this->_tables->prepareStatementForSqlObject($select);
        $return = $category->execute();

        //to loop more the one time through the var
        $resultSet = new ResultSet();
        $resultSet->initialize($return);
        $return = $resultSet->toArray();

        return $return;
    }
    //insert data to table 'orders'
    public function insertOrders($userId, $tableId, $totalPrice)
    {
        $insert = $this->_orders->insert();
        $insert->values(
            [
                'user_id' => $userId,
                'table_id' => $tableId,
                'totalprice' => $totalPrice,
                'timestamp' => date('Y-m-d')
            ]);
        $stmt = $this->_orders->prepareStatementForSqlObject($insert);
        $return = $stmt->execute();
        return $return;
    }

    //get all data from table 'users' where =username
    public function getUsers($username)
    {
        $select = $this->_users->select();
        $select->where(["name" => $username]);
        $category = $this->_tables->prepareStatementForSqlObject($select);
        $result = $category->execute();
        return $result;
    }

    //
    public function getMax()
    {
        $select = $this->_orders->select();
        $select->columns([new Expression ("max(id) AS MaxId")]);
        $stmt = $this->_orders->prepareStatementForSqlObject($select);
        $return = $stmt->execute();
        return $return;
    }


    /**
     * Foodorders Options
     *
     * @param $itemId
     * @param $tableID
     * @param $orderId
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function insertFoodorders($itemId, $tableID, $orderId)
    {
        $insert = $this->_foodorders->insert();
        $insert->values(['item_id' => $itemId,'table_id' => $tableID,'order_id' => $orderId]);
        $stmt = $this->_foodorders->prepareStatementForSqlObject($insert);
        $return = $stmt->execute();
        return $return;

    }

    public function getAllFoodorders(){

        $select = $this->_foodorders->select();
        $foodorders = $this->_foodorders->prepareStatementForSqlObject($select);
        $return = $foodorders->execute();

        //to loop more the one time through the var
        $resultSet = new ResultSet();
        $resultSet->initialize($return);
        $return = $resultSet->toArray();

        return $return;
    }

    public function updateFoodordersStatus($itemId, $statusId)
    {
        $update = $this->_foodorders->update();
        $update->where(['id' => $itemId]);
        $update->set(['status_id' => $statusId]);

        $foodorders = $this->_foodorders->prepareStatementForSqlObject($update);
        $return = $foodorders->execute();

        //to loop more the one time through the var
        $resultSet = new ResultSet();
        $resultSet->initialize($return);
        $return = $resultSet->toArray();

    }

    public function removeSingleFoodorderWithItemId($itemId)
    {
        $delete = $this->_foodorders->delete();
        $delete->where(['item_id' => $itemId]);

        $item = $this->_foodorders->prepareStatementForSqlObject($delete);
        $return = $item->execute();

        //to loop more the one time through the var
        $resultSet = new ResultSet();
        $resultSet->initialize($return);
    }

    /**
     * @param $itemId
     */
    public function removeSingleItem($itemId)
    {
        $delete = $this->_items->delete();
        $delete->where(['id' => $itemId]);

        $item = $this->_items->prepareStatementForSqlObject($delete);
        $return = $item->execute();

        //to loop more the one time through the var
        $resultSet = new ResultSet();
        $resultSet->initialize($return);
//        $return = $resultSet->toArray();
    }

    /**
     * @param $categoryId
     * @param $articleName
     * @param $articlePrice
     */
    public function insertItems($categoryId, $articleName, $articlePrice)
    {
        $insert = $this->_items->insert();
        $insert->values(['name' => $articleName,'price' => $articlePrice,'category' => $categoryId]);
        $stmt = $this->_items->prepareStatementForSqlObject($insert);
        $stmt->execute();
//        return $return;

    }

    public function getLatestItem()
    {
        $select = $this->_items->select();
        $select->order('id DESC');
        $select->limit(1);
        $stmt = $this->_items->prepareStatementForSqlObject($select);
        $return = $stmt->execute();

        //to loop more the one time through the var
        $resultSet = new ResultSet();
        $resultSet->initialize($return);
        $return = $resultSet->toArray();

        return $return;
    }

    public function createCategory($categoryName)
    {
        $insert = $this->_category->insert();
        $insert->values(['name' => $categoryName]);
        $stmt = $this->_category->prepareStatementForSqlObject($insert);
        $stmt->execute();

    }

    public function removeCategory($id)
    {
        $delete = $this->_category->delete();
        $delete->where(['id' => $id]);

        $category = $this->_category->prepareStatementForSqlObject($delete);
        $return = $category->execute();

        //to loop more the one time through the var
        $resultSet = new ResultSet();
        $resultSet->initialize($return);
    }

    public function getLatestFromCategory()
    {
        $select = $this->_category->select();
        $select->order('id DESC');
        $select->limit(1);
        $stmt = $this->_category->prepareStatementForSqlObject($select);
        $return = $stmt->execute();

        $resultSet = new ResultSet();
        $resultSet->initialize($return);
        $return = $resultSet->toArray();

        return $return;
    }

    /**
     * Get all orders from a single waitress by date in manager
     * @param $username
     * @return \Zend\Db\Adapter\Driver\ResultInterface
     */
    public function getAllOrdersFromUser($userId, $dateTime)
    {
        $select = $this->_orders->select();
        $select->where(["user_id" => $userId]);
        $select->where(["timestamp" => $dateTime]);
        $orderFromUser = $this->_tables->prepareStatementForSqlObject($select);
        $result = $orderFromUser->execute();
        return $result;
    }

}
