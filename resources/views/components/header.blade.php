<nav class="navbar navbar-expand-md navbar-light shadow-sm nagoyameshi-header-container">
   <div class="container">
     <a class="navbar-brand" href="{{ url('/') }}">
       {{ config('app.name', 'Laravel') }}
     </a>
      <form action="{{ route('shops.index') }}" method="GET">
        <input type="text" name="search" placeholder="商品名を入力">
        <button type="submit">検索</button>
      </form>
     
 
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <!-- Right Side Of Navbar -->
       <ul class="navbar-nav ms-auto mr-5 mt-2">
         <!-- Authentication Links -->
         @guest
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
         </li>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
         </li>
         <hr>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('login') }}"><i class="far fa-heart"></i></a>
         </li>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-shopping-cart"></i></a>
         </li>
         @else
         <li class="nav-item mr-5">
            <a class="nav-link" href="{{ route('mypage') }}">
              <i class="fas fa-user mr-1"></i><label>マイページ</label>
            </a>
         </li>
         <li class="nav-item mr-5">
           <a class="nav-link" href="{{ route('mypage.favorite') }}">
             <i class="far fa-heart"></i>
           </a>
         </li>
         @endguest
       </ul>
     </div>
   </div>
 </nav>
