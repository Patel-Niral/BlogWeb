const navitems = document.querySelector('.nav_items');
const navopenbtn = document.querySelector('#open_nav-btn');
const navclosebtn = document.querySelector('#close_nav-btn');


// open nav dropdown
const openNav = ()=>{
    navitems.style.display = 'flex';
    navopenbtn.style.display = 'none';
    navclosebtn.style.display = 'inline-block';
}


// close nav dropdown
const closeNav = () =>{
    navitems.style.display = 'none';
    navopenbtn.style.display = 'inline-block';
    navclosebtn.style.display = 'none';
}

navopenbtn.addEventListener('click', openNav);
navclosebtn.addEventListener('click', closeNav);


const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show_sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide_sidebar-btn');

const showSidebar = ()=>{
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
}
const hideSidebar = ()=>{
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
}

showSidebarBtn.addEventListener('click',showSidebar);
hideSidebarBtn.addEventListener('click', hideSidebar);