import { useForm, router } from "@inertiajs/vue3";
import { usePage } from '@inertiajs/vue3'
const currentPage = usePage();

export default {
    toggle(id) {
        const form = useForm({id});
        const item = currentPage.props.favorites.find(item => item.id == id)
        if(item) {
            form.delete(route('favorites.delete'), {
                replace: false,
                preserveState: true,
            })
        } else {
            form.post(route('favorites.add'), {
                replace:false,
                preserveState: true,
            });
        }
    },
};
