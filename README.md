## 生PHPでMVCを作るためのロードマップ
1. index.php にルーティング機能を作る
    **要件**  
    http://localhost/PathA/PathB/ でアクセスした時、`PathAController.php` の `PathB()` メソッドを呼び出すようにする。  
    PathA がない場合は TopController.php を読み込む。  
    PathB がないときは index() を呼び出すようにする。  
    （例）  
    http://localhost/ でアクセスしたときに TopController.php の index() を読み込むようにする。  
    http://localhost/update/ でアクセスしたときに UpdateController.php の index() を読み込むようにする。  
    http://localhost/top/delete/ でアクセスしたときに TopController.php の delete() を読み込むようにする。  

2. Controller を作る
    呼び出したい view （htmlファイル）を読み込むようにする  
3. View を作る
    適当に画面を作る  
4. Model を作る
    データベースを読み込むクラスを作る
    TopModel.php を作成する  
        select するメソッドを作る  
        insert するメソッドを作る  
        update するメソッドを作る  
        delete するメソッドを作る  