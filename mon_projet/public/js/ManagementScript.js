let mg_links = document.querySelectorAll('.mg-links');
let tables = document.querySelectorAll('.principal table');
let add_button = document.querySelectorAll('.principal .add-button');

if (tables.length == 0)
    mg_links[0].classList.remove('active');


function showTable(e)
{
    let index = e.currentTarget.index;

    if (tables.length == 0)
        window.location.href = 'http://www.exemple.com:8080/management';

    tables.forEach((element)=>{
        element.classList.remove('active');
    });

    tables[index].classList.add('active');

    mg_links.forEach((element)=>{
        element.classList.remove('active');
    });

    mg_links[index].classList.add('active');

    add_button.forEach((element)=>{
        element.classList.remove('active');
    });

    add_button[index].classList.add('active');

}

mg_links.forEach(function (element, index){
    element.addEventListener('click', showTable, false);
    element.index = index;
});