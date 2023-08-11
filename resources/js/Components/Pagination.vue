<template>
     <RenderlessPagination
        :data="data"
        :limit="limit"
        :keep-length="keepLength"
        @pagination-change-page="onPaginationChangePage"
        v-slot="slotProps"
    >
        <nav
            v-bind="$attrs"
            aria-label="Pagination"
            v-if="slotProps.computed.total > slotProps.computed.perPage"
        >
            <button
                class="pagination-link btn btn-icon"
                :disabled="!slotProps.computed.prevPageUrl"
                @click.prevent="visit(slotProps.computed.prevPageUrl)"
            >
                <slot name="prev-nav">
                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 6L1 6M1 6L6 11M1 6L6 1" stroke="#0F2B4B" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </slot>
            </button>

            <button
                class="pagination-link"
                :class="{ 'active' : slotProps.computed.currentPage == page }"
                :aria-current="slotProps.computed.currentPage ? 'page' : null"
                v-for="(page, key) in slotProps.computed.pageRange"
                :key="key"
                @click.prevent="visit('product.catalog', '?page=' + page)"
            >
                {{ page }}
            </button>

            <button
                class="pagination-link btn btn-icon"
                :disabled="!slotProps.computed.nextPageUrl"
                @click.prevent="visit(slotProps.computed.nextPageUrl ?? '')"
            >
                <slot name="next-nav">
                    <svg width="10" height="10" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 6H11M11 6L6 1M11 6L6 11" stroke="#0F2B4B" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </slot>
            </button>
        </nav>
    </RenderlessPagination>
    <!-- <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label" />
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url">{{ link.label }}</Link>
            </template>
        </div>
    </div> -->
</template>

<script>

import { router } from '@inertiajs/vue3'
import RenderlessPagination from 'laravel-vue-pagination/src/RenderlessPagination.vue';
export default {
    inheritAttrs: false,
    emits: ['pagination-change-page'],
    components: {
        RenderlessPagination
    },
    props: {
        data: {
            type: Object,
            default: () => {}
        },
        limit: {
            type: Number,
            default: 0
        },
        keepLength: {
            type: Boolean,
            default: false
        },
    },
    methods: {
        onPaginationChangePage(page) {
            this.$emit('pagination-change-page', page);
        },
        visit(link, params = false) {
            params ? router.get(route(link) + params) : router.get(link);
        }
    }
}
</script>