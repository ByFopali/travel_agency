<template>

    <div class="container">
        <h1 class="display-1 text-center">List of tours</h1>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="mt-3 row w-100">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-success" type="button">
                        <router-link class="nav-item nav-link" to="/tours/create">
                            Create a new tour
                        </router-link>
                    </button>
                </div>
            </div>
            <div class="col" v-for="tour in tours" v-bind:key="tour.id">
                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <img :src="imageUrl(tour.image)" alt="tour image" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-name">{{ tour.name }}</h5>
                            <p class="card-location mt-3 d-flex align-items-center">
                                <img src="/storage/img/pin.png" alt="" style="width: 25px;">
                                <span style="margin-left: 5px;">{{ tour.place.name }}, <span style="font-weight: bold;">{{
                                        tour.place.country.name
                                    }}</span></span>
                            </p>
                            <p class="card-description">{{ tour.description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <router-link class="nav-item nav-link" :to="{ path: '/tours/' + tour.id }">
                                        <a href="" class="btn btn-outline-success btn-sm d-block mb-1">Edit</a>
                                    </router-link>
                                    <div>
                                        <button type="button"
                                                v-on:click="deleteTour(tour.id)"
                                                class="btn btn-outline-danger">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span style="margin-right: 3px;">{{ tour.discount.size }}</span>
                                        <img src="/storage/img/discount.png" alt="" style="width: 25px;">
                                    </div>

                                    <span class="d-block">{{
                                            Math.round(tour.price * (1 - tour.discount.size / 100))
                                        }}$</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-danger" role="alert" v-if="errored">
            Помилка, спробуйте ще раз!
        </div>

        <div class="position-fixed top-50 start-50 translate-middle">
            <div class="spinner-border text-info" role="status" v-if="loader">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <nav class="d-flex justify-content-center" aria-label="Page navigation example">
            <ul class="pagination">
                <li :class="{disabled: !pagination.prev_page_url}"
                    @click.prevent="getTours(pagination.prev_page_url)"
                    class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        {{ paginationDuplicate.current_page + ' out of ' + paginationDuplicate.last_page }}
                    </a>
                </li>
                <li :class="{disabled: !pagination.next_page_url}"
                    @click.prevent="getTours(pagination.next_page_url)"
                    class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</template>

<script>
export default {
    data() {
        return {
            tours: [],
            errored: false,
            loader: true,
            pagination: {},
            paginationDuplicate: {},
        };
    },
    methods: {

        deleteTour(id) {
            axios.delete(`/api/tours/${id}`).then(() => {
                this.tours = this.tours.filter((tour) => tour.id !== id);
            });
        },

        imageUrl(imageName) {
            return '/storage/' + imageName
        },

        makePagination(response) {
            let pagination = {
                current_page: response.first,
                last_page: response.last,
                prev_page_url: response.prev,
                next_page_url: response.next,
            }
            this.pagination = pagination
        },

        makePaginationDuplicate(response) {
            let pagination = {
                current_page: response.current_page,
                last_page: response.last_page,
            }
            this.paginationDuplicate = pagination
        },

        getTours(page_url) {

            page_url = page_url || '/api/tours'

            axios.get(page_url)
                .then(response => {
                    this.tours = response.data.data
                    this.makePagination(response.data.links)
                    this.makePaginationDuplicate(response.data.meta)
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => {
                    this.loader = false
                })
        }
    },

    mounted() {
        this.getTours()
    }

}
</script>

<style scoped>

.pagination li.disabled {
    pointer-events: none;
    color: gray;
}

.card-name {
    text-transform: uppercase;
}

.pagination > li > a:hover,
.pagination > li > span:hover,
.pagination > li > a:focus,
.pagination > li > span:focus {
    background-color: transparent;
    outline: none;
    box-shadow: none;
}

</style>
