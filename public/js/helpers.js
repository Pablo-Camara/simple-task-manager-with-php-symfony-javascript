function ready(callback){
    // in case the document is already rendered
    if (document.readyState!='loading') callback();
    // modern browsers
    else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
    // IE <= 8
    else document.attachEvent('onreadystatechange', function(){
        if (document.readyState=='complete') callback();
    });
}


function toggleMenu(menu_id){
  var menu = document.getElementById(menu_id);
  if(menu.style.display === 'none')menu.style.display = 'block';
  else menu.style.display = 'none';
};


function isMenuOpen(menu_id){
  var menu = document.getElementById(menu_id);
  return !(menu.style.display === 'none');
}

function openMenu(menu_id){
  var menu = document.getElementById(menu_id);
  menu.style.display = 'block';
}

function closeMenu(menu_id){
  var menu = document.getElementById(menu_id);
  menu.style.display = 'none';
}
