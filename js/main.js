const elements = {
    mainFrame: document.querySelector('.js_mainFrame'),
    firstNameInput: document.querySelector('.js_firstName'),
    lastNameInput: document.querySelector('.js_lastName'),
    addressInput: document.querySelector('.js_address'),
    phoneNumberInput: document.querySelector('.js_phoneNumber'),
    cleanBtn: document.querySelector('.js_cleanBtn'),
    saveBtn: document.querySelector('.js_saveBtn'),
    messageBox: document.querySelector('.js_messageBox'),
};

const {
    mainFrame,
    firstNameInput,
    lastNameInput,
    addressInput,
    phoneNumberInput,
    cleanBtn,
    saveBtn,
    messageBox,
} = elements;

const inputElements = [
    firstNameInput,
    lastNameInput,
    addressInput,
    phoneNumberInput,
];

cleanBtn.addEventListener('click', cleanInputsHandler);
saveBtn.addEventListener('click', saveDataHandler);

function cleanInputsHandler() {
    inputElements.forEach(el => el.value = null);
}

function saveDataHandler(event) {
    messageBox.textContent = '';

    const data = {
        firstName: firstNameInput.value,
        lastName: lastNameInput.value,
        address: addressInput.value,
        phoneNumber: phoneNumberInput.value,
    };

    const options = {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    };

    fetch('./saveDataHandler.php', options)
        .then(res => {
            const { status } = res;
            if (status < 200 || res > 299) {
                throw new Error(
                    `Invalid status code: ${status}. Message: ${res.text()}`
                );
            }

            return res.text();
        })
        .then(res => {
            mainFrame.contentWindow.location.reload(true);
            cleanInputsHandler();
        })
        .catch(err => {
            const { message } = err;
            console.error('Save handler error: ', message);
            console.error(err);
            
            cleanInputsHandler();
            messageBox.textContent = message;
        });
}