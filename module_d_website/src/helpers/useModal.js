import {markRaw, ref} from "vue";

const isOpen = ref(false);
const component = ref(null);
const options = ref({});

export const useModal = () => {
    function open(target, targetOptions = {}) {
        close();
        setTimeout(() => {
            component.value = markRaw(target);
            options.value = targetOptions;
            isOpen.value = true;
        }, 300)
    }

    function close() {
        isOpen.value = false;
        component.value = null;
        options.value = {};
    }

    return {
        open,
        close,
        isOpen,
        component,
        options,
    }
}