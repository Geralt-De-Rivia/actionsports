

<div class="sidebar" data-color="white" data-active-color="primary">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{asset('/img/logo.png')}}">
            </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            Action Sport
            <!-- <div class="logo-image-big">
              <img src="../assets/img/logo-big.png">
            </div> -->
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @include('layouts.menu')

        </ul>
    </div>
</div>