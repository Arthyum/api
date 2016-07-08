<?php

namespace api\Controller;

use api\DAO\CountryDAO;
use api\DAO\LtProductShopDAO;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use api\Domain\Article;
use api\Domain\Category;
use api\Domain\Product;
use api\Domain\Client;
use api\Domain\Sell;
use api\Domain\Country;
use api\Domain\Shop;
use api\Domain\Pt_tva;
use api\Domain\Stock;
use api\Domain\Ticket;
use api\Domain\User;
use api\Domain\Payment;

class ApiController {

    /**
     * API create article controller.
     *
     * @param Request $request Incoming request
     * @param Application $app Silex application
     *
     * @return Article details in JSON format
     */
    public function addArticleAction(Request $request, Application $app) {
        // Check request parameters
        if (!$request->request->has('title')) {
            return $app->json('Missing required parameter: title', 400);
        }
        if (!$request->request->has('content')) {
            return $app->json('Missing required parameter: content', 400);
        }
        // Build and save the new article
        $article = new Article();
        $article->setTitle($request->request->get('title'));
        $article->setContent($request->request->get('content'));
        $app['dao.article']->save($article);
        $responseData = $this->buildArticleArray($article);
        return $app->json($responseData, 201);  // 201 = Created
    }
    public function addSellAction(Request $request, Application $app) {
        // Check request parameters
        /*
        if (!$request->request->has('id')) {
            return $app->json('Missing required parameter: id', 400);
        }*/
        if (!$request->request->has('id_product_shop')) {
            return $app->json('Missing required parameter: id_product_shop', 400);
        }
        if (!$request->request->has('id_client')) {
            return $app->json('Missing required parameter: id_client', 400);
        }
        if (!$request->request->has('quantity')) {
            return $app->json('Missing required parameter: quantity', 400);
        }
        if (!$request->request->has('sell_date')) {
            return $app->json('Missing required parameter: sell date', 400);
        }
        // Build and save the new article
        $sell = new Sell();
       // $sell->setId($request->request->get('id'));
        $sell->setIdProductShop($request->request->get('id_product_shop'));
        $sell->setIdClient($request->request->get('id_client'));
        $sell->setQuantity($request->request->get('quantity'));
        $sell->setDate($request->request->get('sell_date'));

        $app['dao.article']->save($sell);
        $responseData = $this->buildArticleArray($sell);
        return $app->json($responseData, 201);  // 201 = Created
    }
    /**
     * API delete article controller.
     *
     * @param integer $id Article id
     * @param Application $app Silex application
     */
    public function deleteArticleAction($id, Application $app) {
        // Delete all associated comments
        $app['dao.comment']->deleteAllByArticle($id);
        // Delete the article
        $app['dao.article']->delete($id);
        return $app->json('No Content', 204);  // 204 = No content
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addCategoryAction(Request $request, Application $app) {
        // Check request parameters
        if (!$request->request->has('label')) {
            return $app->json('Missing required parameter: label', 400);
        }
        // Build and save the new article
        $category = new Category();
        $category->setLabel($request->request->get('label'));
        $app['dao.category']->save($category);
        $responseData = $this->buildCategoryArray($category);
        return $app->json($responseData, 201);  // 201 = Created
    }
    public function saveCart(Request$request, Application $app){
        if (!$request->request->has('idStore')) {
            return $app->json('Missing required parameter: idStore', 400);
        }
        $idStore = $request->request->get('idStore');
        $idClient = $request->request->get('idClient');
        $stocks = array();
        $products = $request->request->get('products');
            foreach ($products as $product){
                /* Sub qty from initial stock */
                $stock = new Stock();
                $stock->setIdProduct($product['id']);
                $stock->setIdStore($idStore);
                $stock->setQuantity($product['qty']);
                $app['dao.stock']->updateQuantity($stock);
                $stocks = $stock;

                $sell = new Sell();
                $sell->setIdClient($idClient);
                $sell->setQuantity($product['qty']);
                $sell->setDate(date("Y-m-d H:i:s"));

                $ltProductShop = $app['dao.ltproductshop']->findByProductIdShopId($product['id'], $idStore);
                $sell->setIdProductShop(  $ltProductShop->getId());

                $app['dao.sell']->save($sell);
            }
        return $app->json($stocks, 201);  // 201 = Created
    }
    /**
     * API category controller.
     *
     * @param Application $app Silex application
     *
     * @return All categories in JSON format
     */
    public function getCategoriesAction(Application $app) {
        $categories = $app['dao.category']->findAll();
        // Convert an array of objects ($articles) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($categories as $category) {
            $responseData[] = $this->buildCategoryArray($category);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }
    /**
     * API products controller.
     *
     * @param Application $app Silex application
     *
     * @return All product in JSON format
     */
    public function getProductsAction(Application $app) {
        $products = $app['dao.product']->findAll();
        // Convert an array of objects ($articles) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($products as $product) {
            $responseData[] = $this->buildProductArray($product);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }
    public function getShopsAction(Application $app) {
        $shops = $app['dao.shop']->findAll();
        // Convert an array of objects ($articles) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($shops as $shop) {
            $responseData[] = $this->buildShopArray($shop);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }
    /**
     * API Product controller.
     *
     * @param Application $app Silex application
     *
     * @return All products by category in JSON format
     */
    public function getProductsByCategoriesAction($id, Application $app){
        $categories = $app['dao.category']->findAll();
        $responseData = array(array());
        $productsData = array();
        foreach ($categories as $category) {
            $categoryData = $this->buildCategoryArray($category);
            $products = $app['dao.product']->findProductsByStoreIdCategoryId($id, $category->getId());
            foreach ($products as $product){
                $tmp = array();
                $tmp = $this->buildProductArray($product);
                $tmp['price'] = $app['dao.product']->getProductPrice($tmp['id']);
                $tmp['quantity'] = $app['dao.product']->getProductQuantity($tmp['id']);

                $productsData[] = $this->buildProductArray($product);
                $responseData[] = $categoryData;
            }
            $categoryData['products'] = $productsData;
            $responseData = $categoryData;
        }
        return $app->json($responseData);
    }
    public function getSellsAction(Application $app){
        $sells = $app['dao.sell']->findAll();
        // Convert an array of objects ($articles) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($sells as $sell) {
            $responseData[] = $this->buildSellArray($sell);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }
    /**
     * Converts an Article object into an associative array for JSON encoding
     *
     * @param Article $article Article object
     *
     * @return array Associative array whose fields are the article properties.
     */
    private function buildArticleArray(Article $article) {
        $data  = array(
            'id' => $article->getId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent()
            );
        return $data;
    }
    /**
     * Converts an Category object into an associative array for JSON encoding
     *
     * @param Category $category Category object
     *
     * @return array Associative array whose fields are the category properties.
     */
    protected function buildCategoryArray(Category $category) {
        $data  = array(
            'id' => $category->getId(),
            'name' => $category->getLabel(),
        );
        return $data;
    }
    protected function buildProductArray(Product $product) {
        $data  = array(
            'id' => $product->getId(),
            'Id_Categorie' => $product->getIdCategory(),
            'name' => $product->getLabel(),
        );
        return $data;
    }
    protected function buildSellArray(Sell $sell){
        $data  = array(
            'Id_Vente' => $sell->getId(),
            'Id_Produit_Magasin' => $sell->getIdProductShop(),
            'Id_Client' => $sell->getIdClient(),
            'Quantite' => $sell->getQuantity(),
            'DateVente' => $sell->getDate(),
        );
        return $data;
    }
    protected function buildCountryArray(Country $country){
        $data  = array(
            'Id_Pays' => $country->getId(),
            'Nom' => $country->getName(),
        );
        return $data;
    }
    protected function buildShopArray(Shop $shop){
        $data  = array(
            'id' => $shop->getId(),
            //'Id_Pays' => $shop->getIdCountry(),
            //'Nom_Ville' => $shop->getTownName(),
            'name' => $shop->getShopName(),
        );
        return $data;
    }
}
