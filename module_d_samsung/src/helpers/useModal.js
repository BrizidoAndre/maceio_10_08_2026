import {markRaw, ref} from "vue";

const isOpen = ref(false);
const options = ref({});
const component = ref(null);

export const useModal = () => {
    function open(target, targetOptions = {}) {
        close();
        setTimeout(() => {
            options.value = targetOptions;
            component.value = markRaw(target);
            isOpen.value = true;
        }, 300)
    }

    function close() {
        isOpen.value = false;
        options.value = {};
        component.value = null
    }

    return {
        open,
        close,
        isOpen,
        options,
        component,
    }
}