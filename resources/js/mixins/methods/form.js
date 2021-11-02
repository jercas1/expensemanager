const processForm = (component) => {
    component.loading = true;
    Object.assign(component.$data.error, component.$options.data().error);
};

const processFormErrors = (component, err) => {
    for (const key in err.response.data.errors) {
        component.error[key] = err.response.data.errors[key][0];
    }
};

export default {
    processForm,
    processFormErrors,
};
