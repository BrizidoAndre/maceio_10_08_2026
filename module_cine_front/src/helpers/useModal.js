import {markRaw, ref} from "vue";

const isOpen = ref(false);
const options = ref({});
const component = ref(null);

export const useModal = () => {
    function close() {
        isOpen.value = false;
        options.value = {};
        component.value = null;
    }

    function open(target, targetOptions = {}) {
        close();
        setTimeout(() => {
            options.value = targetOptions;
            component.value = markRaw(target);
            isOpen.value = true;
        }, 300)
    }

    return {
        close,
        open,
        isOpen,
        options,
        component,
    }
}