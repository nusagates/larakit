import {router} from "@inertiajs/vue3";

export const go = (url) => {
    router.get(url);
}
