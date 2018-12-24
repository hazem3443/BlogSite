<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

1- create the laravel project 
	-go to the folder you want and Git Bash in this location then type
		"composer create-project laravel/laravel lsapp"
	-then change the directory inside this app called lsapp
2-project structure for laravel which is MVC framework
	-app/user.php :
		this file is a model for our framework you can do a folder called models if you want if you have many models in your project but if you don't have many you can write to user.php file
	-app/Http/controllers/controller.php
		this file is a core controller which extends(inherite) the base controller which has all functions that we can use 
	-app/Http/Auth
		this folder contains some controller for login, register, reset passwords, forget passwords so if we enable authentication all these stuff will kick in.
	-----
	NOTE:
	-----
	-we can just create a model and controllers folder and include them in our project but artisan makes it easy to create using CLI that also create folders and files with class and include all of it's dependencies , the name space and all that stuffs 
	-namespace gives this class of this file an identifier just in case if it has the same class name as another or the same functions and so on we know that we can identify them by their namespaces
	-if we want to bring in a file to use then we just say
		"use" what ever that file such as "use Illuminate\Notifications\Notifiable;"
		think of "Illuminate" as laravel core system and you include from it 
	----
	-resources/views/welcome.blade.php
		this directory contain the views,so all laravel views will are going to uses blade template engine
		this file "welcome.blade.php" is in html with some dynamic properties such as 
		-if statments  
		-loops
		variables and so on

	-routes/  in laravel under 5.3 there are in route.php file in app/Http folder but above 5.3 we have 
		a folder called routes/ which contents are 
		-api.php -: if we want to create a RESTFULL api we will bring this middleware here and every this here will be 
		api/whatever 
		-web.php this is the main routes file and contain code much like js or node.js
		such as the default code 
		```
		Route::get('/', function () {
		    return view('welcome');
		});

		```
		-"Route::get" defines what request we are going to handle in this case it is the get and then 
		-the url '/' which stands for a home page and then we have a function this looks alot like JS or Node.JS and then 
		-return view(welcome); which will look in 'resources/views' which will find welcome.blade.php and load that page :)

	-app/Providers we can create providers which basically like services that can do certain things 
	-config folder -:contain all config files such as 
		-database.php -: which defines database you want to use and can include extensions for non-supported databases such as mongoDB also here redis is a cash Manager and nosql daabase 
		-app.php -: contain when you install laravel packages alot of the times you have to add the 'providers' line:138
		also if it has aliases you would put that is 'aliases' line:193

	-storage/ 
		this has to do with using the file system
	-.env 
		is where you put your database credentials
	-tests/
		let you have your unit test
	-public/
		this is where all css and js files are gona be and it is all minified so you will see a big mess in these files and it is being compiled from our 'resources/assets' folder
-----------------------------------------------------------------------------------------------------
-we can add routes to routes/web.php with the request it handles and return any think with that request
we also should separate our views into folders such as pages folder in views which is going to contain the pages controller 
-to create a contoller which will be automatically be added to app/Http/Controllers/OurName
	```php artisan make:controller PagesController```
	also will include all of it's dependencies and it will extends(inherite from) the Controller which will inherite from the BaseController which have many methods that will help us
-to add a new page you have to do the Following::
	1-include this method inside routes/web.php for example like so 
	`Route::get('/services', 'PagesController@services');` 

	2-then create the controller with the previous command after creating the controller for the pages you need to define a publich function inside class(method)
	and return the view with in after doing a certain task
	
	3-then create the view of this page inside views/pages/---.blade.php  and |note| in controller when returning a view we didn't type .blade.php we just type the name  
------------------------------------------------------------------------------------------------------
-----------------BLADE Template Engine-----------
-------------------------------------------------
||Note||--For not repeating our selves in html pages we can use Blade template engine for Laravel which parse html pages for our website
1-in our view we create 'layouts' folder which is going to contain all of our page layouts with '.blade.php' in it
	in this file we need to include the elements that is going to be in every pages that call this file
	also we need to add @yield('content') where we want the content to be added  
2-in our view we create 'pages' folder which is going to contain all of our pages content for each page and create each 		page html code with '.blade.php' and we need to include the layout by 
	`@extends('layouts.app')` which is in layouts/ folder and the file name is app.blade.php
	then we need to put our section in the content field in the layout so we put this code
	```
	@section('content')
    	HTML code
	@endsection
	```
	then blade will parse the html code out to the main content in layout.app in our layout folder
-------------------------------------------------------------------------------------------------------
passing variables to blade :)
----------------------------
1-first we create a variable in method in our controller then with view() function we can pass this variable to BLADE to 	parse it to html in two different ways such that:-
		-`return view('pages.index',compact('title'));`
		-`return view('pages.index')->with('title', $title);`
	also we can pass multiple variables as an array such that :-
		```
		$data = array(
	    	        'title' => 'Services',
	        	    'services' => ['Web Design', 'Programming', 'SEO']
	        	);
	    return view('pages.services')->with($data);
	    ```
2-then in the '---.blade.php' file that receives these variables which called services in this case 
	we need to add the variables name like that in html form -:
		`{{$title}}`
	also we can make use of @if and @foreach in blade engine to use loops and conditions in our form like that -:
	```
	@if(count($services) > 0)
	        <ul>
	        @foreach ($services as $service)
	            <li>{{$service}}</li>
	        @endforeach
	        </ul>
	    @endif
	```
	where services is an array of strings and count() used to count array elements
3-also we can include any page such that 
	`@include('inc.navbar')` 
	that will load the page directly
	|note| --here 'inc' is a directory and 'navbar' is the file name that is going to be included
----------------------------------------------------------------------------------
assets
------
laravel includes Bootstrap by default  
-public/css/app.css --file include every thing being compiled
-resources/assets/sass/_variables.scss --contain all variables for colors, borders etc
-resources/assets/sass/app.scss --import variables file, bootstrab and fonts reference
we need to install npm because in 'resources/assets/sass/app.scss' it imports bootstrab from "node_modules" and we didn't have that
install npm with command `npm install` this command will create a 'node_modules' folder which contain all dependencies
also we can use command to recompile our page css & js assets `npm run dev`
also if we want to contiuously need to recompile the assets we run command `npm run watch`

|NOTE| -- if we want to add our own styles we create a new folder callsd "_custom.scss"
	in the directory '/resources/assets/scss' and put our styles in this file'_custom.scss'
	then import it in 'app.scss' such that
	```
	@import "custom";
	```
	and we didn't have to write '_' because it tells the engine that it is the include 
----------------------------------------------------------------------------------
Deal With database--
--------------------
1-we need to make a controller and model to deal with database with the following commands
	```
	php artisan make:controller PostsController
	``` 
	this command will make a controller file with the name PostsController.php in '/app/Http/Controllers/'
	containing all the dependencies this file will need
	or use the command 
	```
	php artisan make:controller PostsController --resource
	```
	to create our controller with crud methods with certain parameters
	then make a mode with command
	```
	php artisan make:model Post -m
	```	
	|NOTE| -here we make model name Post but the table name will be posts by default we can change the table name by and some of it's field names by writing this code in the file "app/Post.php" inside class that extends model class:-
	-" protected $table = 'posts'; "---change the table name
	-" public $primarykey = 'id'; "---change the primary key field in our case it is 'id' so we can change it 
	-"public $timestamps = true; "---specify our timestamp and turn it off/on 

	this command will create a model which you can see a file in the directory 'app/Post.php'
	and '-m' will do a migration and this will create a database migration file in the directory 
	'database/migrations/*timestamp_id*create_posts_table.php'  
	in this last file we will notice code
	```
	public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }
	```
	this code will run when we run command 'DB migrate' which will create a posts table and id and timestamp columns
	'id' field is a primary key incrementing with each insertion
	timestamp field will contian two fields (craeted_at,updated_at) and will be filled each time we insert data with our application

	so if we want to add more fields(colums) to our database we write in this function such that
	```
	$table->string(title)
	$table->mediumText('body');
	```

	also this code
	```
	public function down()
    {
        Schema::dropIfExists('posts');
    }
	```
	will run when we rollback the migration or recreate it's table fields

	|Note|
	-before running the migration we need to modify .env file to our info in this project 
	```
	DB_DATABASE=lsapp ->app name
	DB_USERNAME=root  ->username of our database
	DB_PASSWORD=	  ->password of our database in my case it is empty input
	```
	-also we are going to get error for using string in our table in 'database/migration/***_create_posts_table'
	so we need to moidify the file 'app/Proviers/AppServiceProvider.php' and add these two lines
	```
	use Illuminate\Support\Facades\Schema;
	```
	and in boot method
	```
	Schema::defaultStringLength(191);
	```
	also go to config/database.php and clear the 'forge' in mysql configuration

	||NOTE|| 
		-in localhost/phpmyadmin you will find a migratons table which will keep track of our mgrations
		-we can deal with database with tinker which uses Eloguent(ORM) to deal with database  
		`php artisan tinker` -----> run the command lines to deal with database such these commands

		"App\Post::count()" ----to count the elements in our Posts table
		"$post = new App\Post();"	---will create a new instance and will be held in memory so we can add fields to it
		"$post->title = 'Post One'; "	---will add data to title field in this instance(row)
		"$post->body = 'this is Post One Body';"	---will add data to body field in this instance(row)
		"$post->save();"	---will save our change to our database table and we can see it in phpmyadmin

2-then we need to create our CRUD functionality to our controller by adding methods or use --resource within
	make:controller command to create methods within controller
	then we will see Request object that is used to grap data from a Form tag in html code to grap variables from the form

3-then we will need routes for all of these 
	and using this command 
	"php artisan route:list"
	we can see all routes

	and to create all routes for all methods in our controller we need to write in "routes/web.php" this code 
	```
	Route::resource('posts','PostsController');
	``` 
	this will create all of the routes for us instead of writing it all down for each method in controller

4-after making routes and controller for our posts model we need to put the code in our controller to render our posts to 		which is for now render an empty page for the url "/posts"
	-------------
	----index----
	-------------
	we need to add our model Post in our controller to be able to interact with our database element and use any of the model functions such that -:
	*-`use App\Post; ` this line will be added just before the controller class this will bring model Post to our controller
	
	then we can use model data in our controller such that 
	```
	Post::all(); 
	```
	this will return all rows in our database in Post table(model) but you have to create posts view in new subdirectory in 'resources/views/posts/index.blade.php' the 'lsapp.dev/posts' URL will load this page and we can add html tags after including layouts to this view 
	--------------
	-----show-----
	--------------
	then we need to show each post with it's id so we have to add <a> tag to index view to redirect each post to the url
	' href="posts/{{$post->id}}" '
	then we have to create show function in the controller and put these data to the user then return a view at that url 
	also we can add a button like that
	    `<a href="/posts" class="btn btn-default">Go Back</a>`

	we can order data by it's field(colume) name and specify wheather it is descending or ascending using these two keywords
	'desc','asc'
	as follows
	`$posts = Post::orderBy('title','desc')->get();` ---this will return the posts in descending order or the most recent
	`$post = Post::where('title','Post Two')->get();`---find the post by value in it like find
	-------|Note|-------------
	if we want to write a query to the database-: 
		1-we bring the DB library with `use DB;`
		2-execute a query with command `$posts = DB::select('SELECT * FROM posts');`

	we also can separate data into pages and do that with data-base to get data by limit for each page we can do this as-:
	`$posts = Post::orderBy('title','desc')->paginate(10);`separate data into pages for 10 element/page in the controller
	after do @foreach in the view you can do such that to allow pages after hitting the limit of the paginate() input 
	`{{$posts->links()}}` this will be after the @endforeach 
	--------------
	-create-store-
	--------------
	as we do before we return a view from the controller and create a new file in posts called create.blade.php
	then we need to setup laravel collective in order to be able to collect data from the form and send these data to our data base 
		1- start with composer command to setup form collective
			`composer require "laravelcollective/html":"^5.4.0"`
			then add these lines in config/app.php
			``` 'providers' => [
    			  // ...
    			  Collective\Html\HtmlServiceProvider::class,
    			  // ...
  				],
			```
			```
			'aliases' => [
  			  // ...
  			    'Form' => Collective\Html\FormFacade::class,
  			    'Html' => Collective\Html\HtmlFacade::class,
  			  // ...
  			],
			```
		2- then we need to create a form and use store function(method) to submit data to 
			and then specify the method we are gonna use which is POST as follows in the view
			```
			{!! Form::open(['action' => 'PostsController@store', 'method'=>'POST' ]) !!}
    			
    		{!! Form::close() !!}
			```
			then within this form we want to create label and text input field
			such that
			```
			{{Form::label('title','Title')}}
			```
			this code going to generate label "<label for="title">Title</label>"
			```
			{{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
			```
			the second argument is the value we are gonna read
			this code will generate input field like this
			"<input name="title" class="form-control" id="title" type="text" placeholder="Title" value=""> "
			so in our page we are going to add this code
			```
			{!! Form::open(['action' => 'PostsController@store', 'method'=>'POST' ]) !!}
    		    <div class="form-groub">
    		        {{Form::label('title','Title')}}
    		        {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
    		    </div>
    		    <div class="form-groub">
    		        {{Form::label('body','Body')}}
    		        {{Form::textarea('body', '', ['class'=>'form-control', 'placeholder'=>'Body Text'])}}
    		    </div>
    		    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    		{!! Form::close() !!}
			```
			this code contain the code that is going to be submitted to store method in our PostsController
			using POST method
			these data are text,textarea
			which will contain data we are gonna submit to our data base
			and a submit button that is going to send the form data to our store function or controller :)
		3-now back to our PostsController we need to validate our input if it is required to submit the form or not
			such that
			```
			$this->validate($request, [
          	  'title'=>'required',
         	  'body'=>'required'
        	]);
			``` 
		4-then we need some messages to flash error in form to the user to Enter the missing fields so we need to create 
			"resources/views/inc/messages.blade.php"
			here we want to check
			-*errors array* that created when we fail validation 
			-*session values* session success and session error those going to be flash messages that we can create at any point
			
			we can do these two checks in the messages view as follows
			```
			@if (count($errors) > 0)
			    @foreach ($errors->all() as $error)
			        <div class="alert alert-danger">
			            {{$error}}
			        </div>        
			    @endforeach
			@endif
			
			@if (session('success'))
			    <div class="alert alert-success">
			        {{session('success')}}
			    </div>
			@endif
			
			@if (session('error'))
			    <div class="alert alert-danger">
			        {{session('error')}}
			    </div>
			@endif
			```
			here we loop throw errors and print it with div and then check if there is a session success then print this session or if it is not print this error
			also we can send a success message to the view from our controller using with method as follows
			`->with('success','Post Created')` 
			for example 
			`return redirect('/posts')->with('success','Post Created');`
			which will redirect to /posts page with a success flashing message say Post Created 
-----------------------------------------------------------------------
----------implement the Editor for the form body input field-----------
-----------------------------------------------------------------------
we have to include it in our page from ckeditor implemented for laravel from this link follow the documentation for setup
------------https://github.com/UniSharp/laravel-ckeditor
then afer publish the resources you need to add this script tag to end of your page 
```
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
``` 
then add id to your input field with the name 'article-ckeditor' you can do this like that
```
	{{Form::textarea('body', '', ['id' => 'article-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
```
then if we enter text in it then we want to show it then the {{}} won't parse the html code in it because code editor send data in html form so instead of using {{}} 
we will use {!!$post->body} this will parse the HTML within data brought from database

	---------------------
	-----edit-updat------
	---------------------
	so to do our edit function we need to go to the url '/posts/{{$post->id}}/edit' which is going to be added to our show view as <a> tag with reference like follows
	`<a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>`
	then create edit view in directory 'resources/views/posts/edit.blade.php'
	then this form will post the changed in body & title to 'update' method in our PostsController within the form with POST method and also we have pass the variable $post->id to our update method like that
		`{!! Form::open(['action' => ['PostsController@update',$post->id], 'method'=>'POST' ]) !!}`
	-*-but here if we list all routes of our website we will notice a PUT|PATCH method for posts.update and  
		we can't change Form::open method to use PUT method because laravel didn't allow any method execpt GET & POST
		but we can handle other methods by adding a hidden tag to our form like this
	```
	{{Form::hidden('_method','PUT')}}
	```
	then data will be sent to update method correctly as a $request and $post->id 
	and here we can write to update function which should do the following
	 	-alidate the required input
	 	-pdate this element
	 	-ave the changed to the database 

	--------------
	----delete----
	--------------
		just adding a form that will post to destroy method in our controller then adding a button that submit this form as follows
		```
		    {!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
    		    {{Form::hidden('_method','DELETE')}}
    		    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
    		{!!Form::close()!!}
		``` 
		this will submit a request with $post->id to destroy also we are gonna spoof the delete command by adding a hidden tag with method DELETE in it 
		and in our PostsController we need to delete this element by it's id such that
		```
		    $post = Post::find($id);
        	$post->delete();
        	return redirect('/posts')->with('success','Post Removed');
		```
		then we will redirect to our posts with a flashing message completion
----------------------------------------------------------------------------------------------------------------
----------------------------------------AUTHENTICATION----------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
1- `php artisan make:auth`
	this comamnd will enable all the user model and all the controllers the app/Http/Auth controllers in this directory
	and we are going to have a loggin system this command will asks for creating a view for this logging system which is a 
	"resources/views/layouts/app.blade.php" file we have created before  and create an auth directory which will contain all the views for register and logging pages and passwords folder with email and reset views

	if you look into "resources/views/layouts/app.blade.php" you will find many things that we can use such as csrf toker
	for now this command creates many things such as
	-views
		-auth   -->that contain all authentication pages that we will use for logging system 
		-layouts -->that contain app.blade.php that contain many usefull things that may help us 
		-home.blade.php --->this will load our home view
	-controller
		-home controller
----------------------------------------------------------------------------
|||As a task we want to change the name of home controller to dashboard ?|||
----------------------------------------------------------------------------
	1-start with the controller 
		-change the file name 
		-method name 
		-the view name also
	2-Auth/
		-LoginController.php
		-RegisterController.php          ->in this three files you need to change each /home redirect to /dashboard
		-ResetPasswordController.php
	3-routes/
		-web.php -->change route from /home to /dashboard and controller name to DashboardController@index and you can remove the ->name('home') method 
	4-resources/view/
		-home.blade.php  --->change it's name to dashboard.blade.php
	5- and any other method or url to /home in any view or controller from you have used


--------------------------------------------------------------------------------
Another Task
-----------------------------------------------------------------
|||what if we want to add field of user_id to our posts table?|||
-----------------------------------------------------------------
1-we have to create a table called 'add_user_id_to_posts' with this command
	`php artisan make:migration add_user_id_to_posts`
2-edit code in directory 'database/****add_user_id_to_posts' to allow appending this table with one colume we will create
	to the posts table with Schema::table method such that 
	```
	public function up()
    {
        Schema::table('posts', function($table){
            $table->integer('user_id');
        });
    }
    public function down()
    {
        Schema::table('posts', function($table){
            $table->dropColumn('user_id');
        });
    }
	```
	the up method will take posts table as reference and add user_id column to it
	and down method will drop that column when we rollback our database migration 
3-then make a migration to add this column to the database
	'php artisan migrate'
----------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------
--------------------------------------Models Relationships-----------------------------------------
---------------------------------------------------------------------------------------------------
Now we want to add relationship between posts and the users each user has many posts and the post belongs to a specific user and we want to say that in models of user and posts such that
in Posts
```
    public function user(){
        return $this->belongsTo('App\User');
    } 
```
in Users
```
public function posts(){
        return $this->hasMany('App\Post');
    }
```
and we need to include App\User; where we are going to use 'User' model and it's post method we have created which has relationship with many posts by user_id of each post 

then in our DashboardController we need to show each user posts according to logged user 
-in index method in the DashboardController we do this
	```
		$user_id = auth()->user()->id;
		$user = User::find($user_id);
		return view('dashboard')->with('posts',$user->posts);
	```
	to get the user's id of the logged in user then find this user in the database by his id so as we used User mode we need to include it in this file like that
	`use App\User; ` in the beggining of this file
	then we pass the logged user posts to dashboard view so we need to print it out there
	so in dashboard.blade.php
	
	```
		@if (count($posts)>0)
            <table class="table table-striped">
				<tr>
				    <th>Title</th>
				    <th></th>
				    <th></th>
				</tr>
                @foreach ($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>
                	<td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                	<td>
            		{!!Form::open(['action'=>['PostsController@destroy',$post->id],method'=>'POST','class'=>'pull-right'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                    {!!Form::close()!!}
                    </td>
                </tr>
                @endforeach
			</table>
        @else
			<p>You has no posts</p>
        @endif
	```
here we added a button to edit and delete each element and add a layer of validation to check whether there is a posts to view or not 

------
|Note|
------
since we have a relationship between the two tables(Post, User) we can call users name from his post and viceversa such that
{{$post->user->name}}

-------------------------------------------------------------------------------------------------------------

-------------------------------------------------------------------------------------------------------------
----------------------------------Access Control (Authorization)---------------------------------------------
-------------------------------------------------------------------------------------------------------------
if we look at the __construct() method which is the constructor in DashboardController this uses a middleware that is going to block any unauthenticated access to unauthorized url you can test this out by visiting any url that DashboardController use such as  /dashboard which visites the index method with dashboard constructor which check authority   
so if we want to add a layer of authorization to our PostsController we need to add this constructor to it
```
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }
``` 
which adds some exceptions for some methods such as index and show methods of PostsController to show the user's posts but not allowed to create or delete any thing till login
and we can show and hide delete & edit buttons for each user such that
```
@if (!Auth::guest())
    @if (Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
        {!! Form::open(['action' => ['PostsController@destroy',$post->id], 'method'=>'POST', 'class'=>'pull-right']) !!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif    
@endif
``` 
where we check if this user is logged in then chech if this post is for this logged user then show him the edit and delete buttons

-------------------------------------------------
--prevent users from changing other user's data--
-------------------------------------------------
then we want to check the url because if we type url for editing other user's post it will access which is not allowed
also the same with delete 
```
	//check for correct user
	if(auth()->user()->id !== $post->user_id){
	    return redirect('/posts')->with('error','Unauthorized Page');    
	}
```
so here we check for the logged user's id if it is not equal to the post's user_id it will be redirect to /posts Url with a flash message 'Unauthorized Page'

-------------------------------------------------------------------------------------------
------------------------------Add File Uploading-------------------------------------------
-------------------------------------------------------------------------------------------
1-we need to add a Form::submit button in the form that is going to submit this file we want to uploaded and the form had 
	to have an enctype attribute in the form and we need to set it to multi-part form data such that 
	'enctype'=>'multipart/form-data' now UI is done and if we submit it nothing happend :)

2-now we need to add another column to the posts table cover_image column so we will do a migration as follows
	-run this command `php artisan make:migration add_cover_image_to_posts`
	-add the cover_image field to the database in the database/migrations/****add_cover_image_to_posts
		```
		public function up()
    	{
    	    Schema::table('posts', function($table){
    	        $table->string('cover_image');
    	    });
    	}
		```
		which will add cover image field when run migrate command and 
		```
		public function up()
    	{
    	    Schema::table('posts', function($table){
    	        $table->dropColumn('cover_image');
    	    });
    	}
		```
		which will drop the column when rollback the database
	-then run the migrate command

3-then the data will be sent to the store method in our PostsController and we want to validate that these data is 
	image and not required and have max size of 1.99 megabyte because apache server the default upload size is 2 megabytes the code is such that
	` 'cover_image'=>'image|nullable|max:1999' `

4-then we need to handle the file uploaded and save it somewhere with it's name but if two users uploade a file with 
	the same name error will occure because data will be overriden so we need to append a timestamp to the file name
	also when we store file on our server it will be added to this directory "storage/app/public" and we are going to create a folder called "cover_images" to store blogs photos in it and the name of each photo will be stored in the database with a unique timestamp 
	```
	    //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get file name with extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension ;
            //Uploade the Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
	``` 
	but istead of storing images in 'storage/app/public/cover_images' we will use artisan command to make link(shortcut)
	to the "public" folder in our main app directory this operation is done by something called symlink 
	` php artisan storage:link `

5-Now we want to show it in our view/posts with this code like that
	```
	<div class="row">
        <div class="col-md-4 col-sm-4">
            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
        </div>
        <div class="col-md-8 col-sm-8">
            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
            <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
        </div>
    </div>
	```
	which is in @foreach block for each post
	and also we need to copy the image tag to show function to shop post image there too

	----Edit----
	and we want to add the upload image to the edit method too just as we did here with no changes but notice the functionality that the edit gona implement if there is now image in the input field it is not gona place noimage.jpg but instead it is gona leave the image as it is also before passing the image name to the database we have to check if this image is entered or null to avoid filling the image field in the database with null value

	----DELETE---
	mean delete the image in the storage folder if it is not noimage.jpg to do that we will need Storage Library which we will include in our controller like that
	` use Illuminate\Support\Facades\Storage; `
	and in the destroy method we need to check that the image we are going to remove is not the noimage.jpg like this
	```
	    if($post->cover_image != 'noimage.jpg'){
            //Delete the image from storage
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
	```
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
-------------------------------------------------DEPLOY---------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------

-we have to know that the shared hosting will have everything setup for you  
