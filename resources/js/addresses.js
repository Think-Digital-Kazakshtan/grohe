import { useForm, router } from "@inertiajs/vue3";
import { usePage } from '@inertiajs/vue3'
const currentPage = usePage()

export default {
    add(id) {
        const form = useForm({id});
         form.post(route('addresses.add'), {
            replace:false,
            preserveState: true,
        });
    },

    update(id) {
        const form = useForm({id});
        form.put(route('addresses.update'), {
            replace: false,
            preserveState: true,
        })
    },

    remove(id) {
        const form = useForm({id});
        form.delete(route('addresses.delete'), {
            replace: false,
            preserveState: true,
        })
    }
};