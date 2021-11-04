const processForm = (component) => {
    component.loading = true;
    Object.assign(component.$data.error, component.$options.data().error);
};

const processFormErrors = (component, err) => {
    for (const key in err.response.data.errors) {
        component.error[key] = err.response.data.errors[key][0];
    }
};

const resetForm = (component) => {
    Object.assign(component.$data.form, component.$options.data().form);
    Object.assign(component.$data.error, component.$options.data().error);
};

const showDeleteConfirmation = (component, name) => {
    component
        .$swal({
            icon: "question",
            title: "Delete Confirmation",
            text: `Are you sure you want to delete "${name}"?`,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        })
        .then((result) => {
            if (result.value) {
                component.delete();
            }
        });
};

const checkUserFunction = (user_functions, module, role_function) => {
    return user_functions.findIndex(ufunction => ufunction.module === module && ufunction.function === role_function) >= 0 ? true : false;
}

export default {
    processForm,
    processFormErrors,
    resetForm,
    showDeleteConfirmation,
    checkUserFunction,
};
