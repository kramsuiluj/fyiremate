const options = document.getElementById('options');
const optionItems = document.getElementById('option-items');
const dropdownContainer = document.getElementById('dropdown-container');

options.addEventListener('click', () => {
    if (optionItems.style.display === 'none') {
        optionItems.style.display = 'block';
    } else {
        optionItems.style.display = 'none';
    }
});

const logout = document.getElementById('logout');
const logoutForm = document.getElementById('logout-form');

logout.addEventListener('click', () => {
    logoutForm.submit();
});


const toggle = document.getElementById('toggle');
const openIcon = document.getElementById('open');
const closeIcon = document.getElementById('close');
const sideNavigation = document.getElementById('side-nav');
const subHeader = document.getElementById('sub-header');
const mainContainer = document.getElementById('main-container');

toggle.addEventListener('click', () => {
    if (closeIcon.style.display === 'none') {
        openIcon.style.display = 'none';
        closeIcon.style.display = 'block';
        sideNavigation.style.width = '0';
        subHeader.style.marginLeft = '0';
        mainContainer.style.marginLeft = '0';
    } else {
        openIcon.style.display = 'block';
        closeIcon.style.display = 'none';
        sideNavigation.style.width = '12rem';
        subHeader.style.marginLeft = '12rem';
        mainContainer.style.marginLeft = '12rem';
    }
});

const personnel = document.getElementById('personnel');
const personnelCategories = document.getElementById('personnel-categories');

if (personnel !== null) {
    personnel.addEventListener('click', () => {
        if (personnelCategories.style.display === 'none') {
            personnelCategories.style.display = 'block';
        } else {
            personnelCategories.style.display = 'none';
        }
    });
}

// const reports = document.getElementById('reports');
// const reportCategories = document.getElementById('report-categories');
//
// reports.addEventListener('click', () => {
//     if (reportCategories.style.display === 'none') {
//         reportCategories.style.display = 'block';
//     } else {
//         reportCategories.style.display = 'none';
//     }
// });

document.addEventListener('click', (event) => {
    let element = event.target;

    if (!dropdownContainer.contains(element)) {
        optionItems.style.display = 'none';
    }
});

function showLoading() {
    document.querySelector('#loading').classList.add('loading');
    document.querySelector('#loading-content').classList.add('loading-content');
}

function hideLoading() {
    document.querySelector('#loading').classList.remove('loading');
    document.querySelector('#loading-content').classList.remove('loading-content');
}
