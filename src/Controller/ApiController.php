<?php

namespace api\Controller;

use api\Domain\Product;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use api\Domain\Article;
use api\Domain\Category;

class ApiController {

    /**
     * API articles controller.
     *
     * @param Application $app Silex application
     *
     * @return All articles in JSON format
     */
    public function getArticlesAction(Application $app) {
        $articles = $app['dao.article']->findAll();
        // Convert an array of objects ($articles) into an array of associative arrays ($responseData)
        $responseData = array();
        foreach ($articles as $article) {
            $responseData[] = $this->buildArticleArray($article);
        }
        // Create and return a JSON response
        return $app->json($responseData);
    }

    /**
     * API article details controller.
     *
     * @param integer $id Article id
     * @param Application $app Silex application
     *
     * @return Article details in JSON format
     */
    public function getArticleAction($id, Application $app) {
        $article = $app['dao.article']->find($id);
        $responseData = $this->buildArticleArray($article);
        // Create and return a JSON response
        return $app->json($responseData);
    }

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
     * API category controller.
     *
     * @param Application $app Silex application
     *
     * @return All categories in JSON format
     */
    public function getCategoriesAction(Application $app) {
        $categories = $app['dao.categorie']->findAll();
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
    /**
     * API Product controller.
     *
     * @param Application $app Silex application
     *
     * @return All products by category in JSON format
     */
    public function getProductsByCategoriesAction(Application $app){
        $categories = $app['dao.categorie']->findAll();
        var_dump($categories);
        $responseData = array(array());

        foreach ($categories as $category) {
            $products = $app['dao.product']->findAll();
            //$products = $app['dao.product']->findProductByCategoryId($category->getId());
            var_dump($products);
        //    $responseData[] = $this->buildCategoryArray($category);
        }
        return null;
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
            'Id_Categorie' => $category->getId(),
            'Libelle' => $category->getLabel(),
        );
        return $data;
    }
    protected function buildProductArray(Product $product) {
        $data  = array(
            'Id_Produit' => $product->getId(),
            'Id_Categorie' => $product->getIdCategory(),
            'Id_Stock' => $product->getIdStock(),
            'Libelle' => $product->getLabel(),
        );
        return $data;
    }
}
