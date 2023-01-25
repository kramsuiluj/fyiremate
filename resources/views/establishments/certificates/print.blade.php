<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>FSIC - {{ $certificate->fsic }}</title>
    <style>

        @page {
            size: a4 portrait;
            margin: 1%;
        }

        #page[data-size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        #page {
            background: linear-gradient(-90deg, rgba(0, 0, 0, .05) 1px, transparent 1px),
            linear-gradient(rgba(0, 0, 0, .05) 1px, transparent 1px),
            linear-gradient(-90deg, rgba(0, 0, 0, .04) 1px, transparent 1px),
            linear-gradient(rgba(0, 0, 0, .04) 1px, transparent 1px),
            linear-gradient(transparent 3px, #f2f2f2 3px, #f2f2f2 78px, transparent 78px),
            linear-gradient(-90deg, #aaa 1px, transparent 1px),
            linear-gradient(-90deg, transparent 3px, #f2f2f2 3px, #f2f2f2 78px, transparent 78px),
            linear-gradient(#aaa 1px, transparent 1px),
            #f2f2f2;
            background-size: 10px 10px,
            10px 10px,
            80px 80px,
            80px 80px,
            80px 80px,
            80px 80px,
            80px 80px,
            80px 80px;
        }

        .draggable {
            position: absolute;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
        }

        header > section {
            width: 21cm;
        }

        @media print {
            section, header {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-900">

<header class="mb-5">
    <section class="bg-gray-200 mx-auto flex justify-between items-center p-2 border-b-2 border-l-2 border-r-2
        border-gray-400 rounded-bl rounded-br">
        <div x-data="{ show: false }" class="flex items-center space-x-3">
            <button id="print" class="flex space-x-1 items-center bg-blue-500 text-white py-1 px-4 rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>

                <span class="font-montserrat text-sm font-semibold">Print</span>
            </button>

            <button @click="show = !show" class="flex space-x-1 items-center bg-orange-500
                text-white py-1 px-4
                rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>

                <span class="font-montserrat text-sm font-semibold">Add Element</span>
            </button>

            <div x-show="show" style="display: none" class="relative z-10" aria-labelledby="modal-title"
                 role="dialog"
                 aria-modal="true">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left space-y-4">
                                        <h3 class="font-montserrat font-semibold leading-6 text-gray-900"
                                            id="modal-title">ADD ELEMENT</h3>
                                        <div class="mt-2">
                                            <div class="space-y-2">
                                                <div class="font-montserrat flex space-x-2">
                                                    <label for="" class="text-sm">Text Content</label>
                                                    <input id="textContent" type="text" class="text-sm bg-gray-50 border border-gray-300 rounded-md w-72">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 font-montserrat">
                                <button @click="show = false" id="add-element" type="button" class="inline-flex
                                    w-full
                                    justify-center
                                    rounded-md border
                                    border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white
                                    shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-red-500
                                    focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Add</button>
                                <button @click="show = false" type="button" class="mt-3 inline-flex w-full
                                    justify-center
                                    rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex space-x-1 items-center font-montserrat">
            <div class="flex w-44 h-8">
                    <span class="inline-flex items-center px-3 text-sm text-white bg-gray-900 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        X
                      </span>
                <input type="text" id="x-pos" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-44 text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="X Position">
            </div>
            <div class="flex w-44 h-8">
                    <span class="inline-flex items-center px-3 text-sm text-white bg-gray-900 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Y
                      </span>
                <input type="text" id="y-pos" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-44 text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Y Position">
            </div>
            <button id="save" class="bg-green-500 text-white px-4 rounded font-semibold text-sm h-8" form="positions">SAVE</button>
        </div>
    </section>
</header>

<form id="positions" action="{{ route('certificates.positions') }}" method="POST" style="display: none">
    @csrf
    @method('PATCH')

    <input type="hidden" name="positions">
</form>

<div id="details"
     style="display: none"
     data-fsic-id="{{ $certificate->fsic }}"
     data-filled-date="{{ $certificate->filled_date }}"
     data-applicant="{{ $establishment->owner }}"
     data-address="{{ $establishment->address }}"
     data-description="{{ $certificate->description }}"
     data-description2="{{ $certificate->description2 ?? '' }}"
     data-valid-until="{{ $certificate->valid_until }}"
     data-amount="{{ $establishment->payments->last()->amount_paid }}"
     data-or-number="{{ $establishment->payments->last()->or_number }}"
     data-payment-date="{{ $establishment->payments->last()->date_paid }}"
     data-chief="{{ $certificate->chief }}"
     data-marshal="{{ $certificate->marshal }}"
     data-establishment="{{ $establishment->name }}"
>
</div>

<div id="pos" style="display: none" data-positions="{{ $positions->pos }}">

</div>

<div id="page" class="bg-white relative mx-auto justify-between outline outline-gray-400 box-border"
     data-size="A4">
</div>

<script>
    window.onload = function () {
        let active;
        let activeId;
        const page = document.getElementById('page');
        let xPos = document.getElementById('x-pos');
        let yPos = document.getElementById('y-pos');
        const save = document.getElementById('save');
        const add = document.getElementById('add-element');
        const print = document.getElementById('print');
        let newId = document.getElementById('newId');
        let textContent = document.getElementById('textContent');
        const details = document.getElementById('details').dataset;
        const elements = Object.fromEntries(Object.entries(JSON.parse(JSON.stringify(details))).filter(([_, v]) => v != ""));
        const positions = JSON.parse(document.getElementById('pos').dataset.positions);

        const pos = document.querySelector('[name="positions"]');
        pos.value = JSON.stringify(positions);

        console.log(elements);

        for (const element in elements) {
            const item = document.createElement('div');
            item.id = element;
            item.classList.add('draggable', 'whitespace-nowrap', 'cursor-move');
            item.innerText = elements[element];

            page.append(item);

            $(() => {
                $('#' + element).draggable({
                    containment: '#page',
                    scroll: false,
                    start: (e) => {
                        active = e.target;
                    },
                    drag: (e) => {
                        xPos.value = Math.round(e.target.getBoundingClientRect().left - page.getBoundingClientRect().left);
                        yPos.value = Math.round(e.target.getBoundingClientRect().top - page.getBoundingClientRect().top);

                        activeId = active.id;

                        positions[activeId].x = active.style.left;
                        positions[activeId].y = active.style.top;
                        pos.value = JSON.stringify(positions);
                    },
                    stop: (e) => {
                        xPos.value = Math.round(e.target.getBoundingClientRect().left - page.getBoundingClientRect().left);
                        yPos.value = Math.round(e.target.getBoundingClientRect().top - page.getBoundingClientRect().top);

                        activeId = active.id;

                        positions[activeId].x = active.style.left;
                        positions[activeId].y = active.style.top;
                        pos.value = JSON.stringify(positions);
                    }
                });
            });

            item.addEventListener('click', () => {
                active = item;
                xPos.value = Math.round(active.getBoundingClientRect().left - page.getBoundingClientRect().left);
                yPos.value = Math.round(active.getBoundingClientRect().top - page.getBoundingClientRect().top);
            });
        }

        if (document.getElementById('fsicId')) {
            let fsicId = document.getElementById('fsicId');
            fsicId.style.top = positions.fsicId.y.toString();
            fsicId.style.left = positions.fsicId.x.toString();
        }

        if (document.getElementById('filledDate')) {
            let filledDate = document.getElementById('filledDate');
            filledDate.innerText = filledDate.innerText;
            filledDate.style.top = positions.filledDate.y.toString();
            filledDate.style.left = positions.filledDate.x.toString();
        }

        if (document.getElementById('establishment')) {
            let establishment = document.getElementById('establishment');
            establishment.style.top = positions.establishment.y.toString();
            establishment.style.left = positions.establishment.x.toString();
        }

        if (document.getElementById('applicant')) {
            let applicant = document.getElementById('applicant');
            applicant.style.top = positions.applicant.y.toString();
            applicant.style.left = positions.applicant.x.toString();
        }

        if (document.getElementById('description')) {
            let description = document.getElementById('description');
            description.style.top = positions.description.y.toString();
            description.style.left = positions.description.x.toString();
        }

        if (document.getElementById('description2')) {
            let description = document.getElementById('description2');
            description.style.top = positions.description2.y.toString();
            description.style.left = positions.description2.x.toString();
        }

        if (document.getElementById('address')) {
            let address = document.getElementById('address');
            address.style.top = positions.address.y.toString();
            address.style.left = positions.address.x.toString();
        }

        if (document.getElementById('validUntil')) {
            let validUntil = document.getElementById('validUntil');
            validUntil.innerText = validUntil.innerText;
            validUntil.style.top = positions.validUntil.y.toString();
            validUntil.style.left = positions.validUntil.x.toString();
        }

        if (document.getElementById('chief')) {
            let chief = document.getElementById('chief');
            chief.style.top = positions.chief.y.toString();
            chief.style.left = positions.chief.x.toString();
        }

        if (document.getElementById('marshal')) {
            let marshal = document.getElementById('marshal');
            marshal.style.top = positions.marshal.y.toString();
            marshal.style.left = positions.marshal.x.toString();
        }

        if (document.getElementById('amount')) {
            let amount = document.getElementById('amount');
            amount.style.top = positions.amount.y.toString();
            amount.style.left = positions.amount.x.toString();
        }

        if (document.getElementById('orNumber')) {
            let orNumber = document.getElementById('orNumber');
            orNumber.style.top = positions.orNumber.y.toString();
            orNumber.style.left = positions.orNumber.x.toString();
        }

        if (document.getElementById('paymentDate')) {
            let paymentDate = document.getElementById('paymentDate');
            paymentDate.innerText = paymentDate.innerText;
            paymentDate.style.top = positions.paymentDate.y.toString();
            paymentDate.style.left = positions.paymentDate.x.toString();
        }

        xPos.addEventListener('keydown', () => {
            activeId = active.id;
            active.style.left = xPos.value + 'px';
            positions[activeId].x = active.style.left;
            pos.value = JSON.stringify(positions);
        });

        xPos.addEventListener('keyup', () => {
            activeId = active.id;
            active.style.left = xPos.value + 'px';
            positions[activeId].x = active.style.left;
            pos.value = JSON.stringify(positions);
        });

        yPos.addEventListener('keydown', () => {
            activeId = active.id;
            active.style.top = yPos.value + 'px';
            positions[activeId].y = active.style.top;
            pos.value = JSON.stringify(positions);
        });

        yPos.addEventListener('keyup', () => {
            activeId = active.id;
            active.style.top = yPos.value + 'px';
            positions[activeId].y = active.style.top;
            pos.value = JSON.stringify(positions);
        });

        save.addEventListener('click', () => {
            let id = active.id;
            positions[id].x = xPos.value;
            positions[id].y = yPos.value;
        });

        print.addEventListener('click', () => {
            window.print();
        });

        let id = 1;

        add.addEventListener('click', () => {
            let newElement = document.createElement('div');
            newElement.id = id.toString();
            id++;
            newElement.classList.add('draggable', 'whitespace-nowrap', 'cursor-move');
            newElement.innerText = textContent.value;

            page.append(newElement);

            $(() => {
                $('#' + newElement.id).draggable({
                    containment: '#page',
                    scroll: false,
                    start: (e) => {
                        active = e.target;
                    },
                    drag: (e) => {
                        xPos.value = Math.round(e.target.getBoundingClientRect().left - page.getBoundingClientRect().left);
                        yPos.value = Math.round(e.target.getBoundingClientRect().top - page.getBoundingClientRect().top);
                    }
                });
            });

            newElement.addEventListener('click', () => {
                active = newElement;
                xPos.value = Math.round(active.getBoundingClientRect().left - page.getBoundingClientRect().left);
                yPos.value = Math.round(active.getBoundingClientRect().top - page.getBoundingClientRect().top);
            });

            textContent.value = '';
        });
    }
</script>
</body>
</html>
