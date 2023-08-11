import { usePage } from '@inertiajs/vue3'

const currentPage = usePage()

export default {
    asset: name => `/storage/${name}`,
    setting: (key) => {
        const settings = currentPage.props.settings;
        return settings[key];
    }
}
