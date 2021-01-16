<?php

class StoreController extends Controller {

    public static function index() {
        // Insert all products into a session
        $_SESSION['store-items'] = Product::getProducts();
    }

    /**
     * Get a product in the database and put it in a session
     * 
     */
    public static function getItem() {
        $item_ids = json_decode($_GET['item_id']);
        $store_cart = array();
        
        foreach ($item_ids as $id) {
            array_push($store_cart, Product::getProduct($id));
        }
        
        ob_end_clean();
        echo json_encode($store_cart);
        exit;
    }

    public static function newReciept() {
        $item_ids = json_decode($_POST['purchases']);
        $store_cart = array();
        
        foreach ($item_ids as $id) {
            array_push($store_cart, Product::getProduct($id));
        }

        Receipt::createReceipt($store_cart);

        ob_end_clean();
        echo json_encode($_SERVER['REQUEST_URI']);
        exit;
    }
}