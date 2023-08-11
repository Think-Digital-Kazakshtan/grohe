import { useForm, router } from "@inertiajs/vue3";
import { usePage } from '@inertiajs/vue3'
const currentPage = usePage()

export default {
    add (id, quantity = 1, callback = null) {
        const form = useForm({id, quantity});
         form.post(route('cart.add'), {
            replace:false,
            preserveState: true,
        });
    },

    update(id, quantity = 1) {
        const form = useForm({id, quantity});
        form.put(route('cart.update'), {
            replace: false,
            preserveState: true,
        })
    },

    remove(id, callback = null) {
        const form = useForm({id});
        form.delete(route('cart.delete'), {
            replace: false,
            preserveState: true,
        })
    },

    clear(id) {
        const form = useForm({id});
        form.delete(route('cart.clear'),{
            replace: false,
            preserveState: true,
        })
    }

};
