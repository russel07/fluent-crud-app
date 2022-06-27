import AlertMessage from "@/admin/Bits/AlertMessage";
export default ()=> {
    const { error } = AlertMessage();
    const showError = function(response) {
        if (response.responseJSON) {
            response = response.responseJSON;
        }

        let errorMessage = '';
        if (typeof response === 'string') {
            errorMessage = response;
        } else if (response && response.message) {
            errorMessage = response.message;
        } else {
            errorMessage = convertToString(response);
        }

        error(errorMessage);
    }

    const  convertToString = function (obj) {
        const string = [];
        if (typeof (obj) === 'object' && (obj.join === undefined)) {
            for (const prop in obj) {
                string.push(convertToString(obj[prop]));
            }
        } else if (typeof (obj) === 'object' && !(obj.join === undefined)) {
            for (const prop in obj) {
                string.push(convertToString(obj[prop]));
            }
        } else if (typeof (obj) === 'function') {

        } else if (typeof (obj) === 'string') {
            string.push(obj)
        }

        return string.join('<br />')
    }

    return {
        showError
    }
}
