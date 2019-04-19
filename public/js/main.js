
ready(function(){

  var mainMenuId = 'main-menu',
      mainMenuToggleId = 'main-menu-toggle';

  var mainMenuToggle = document.getElementById(mainMenuToggleId);

  // Close #main-menu when user clicks outside the menu
  window.addEventListener('click', function(e){

    if (!document.getElementById(mainMenuId).contains(e.target) && !mainMenuToggle.contains(e.target)){
        closeMenu(mainMenuId);
        mainMenuToggle.classList.remove('open');
    }


  });

  mainMenuToggle.addEventListener('click', function(e){
    if(!e.target.classList.contains('open')){
      openMenu(mainMenuId);
      mainMenuToggle.classList.add('open');
    } else {
      closeMenu(mainMenuId);
      mainMenuToggle.classList.remove('open');
    }
  });


});
