<template>
    <div class="py-12 px-4 md:px-12">
        <div
            v-if="loader"
            class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-primary-darker"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                style="margin: auto; background: none; display: block; shape-rendering: auto;"
                width="100px"
                height="100px"
                viewBox="0 0 100 100"
                preserveAspectRatio="xMidYMid"
            >
                <circle
                    cx="50"
                    cy="50"
                    fill="none"
                    stroke="#ffffff"
                    stroke-width="10"
                    r="35"
                    stroke-dasharray="164.93361431346415 56.97787143782138"
                >
                    <animateTransform
                        animateTransform
                        attributeName="transform"
                        type="rotate"
                        repeatCount="indefinite"
                        dur="1s"
                        values="0 50 50;360 50 50"
                        keyTimes="0;1"
                    ></animateTransform>
                </circle>
            </svg>
        </div>

        <div
            class="bg-white max-w-sm shadow-xl rounded p-5 mx-auto text-center"
        >
            <h1 class="text-3xl font-medium">{{ translations["Welcome"] }}</h1>
            <p class="text-sm">{{ translations["Please choose a tenant"] }}</p>

            <div class="space-y-5 mt-5 submit-disabled">
                <div class="relative inline-block w-full text-gray-700">
                    <select
                        class="w-full h-10  text-base pl-3 placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"
                        :class="{ 'pr-6': isLTR, 'pr-8': !isLTR }"
                        v-model="tenantId"
                    >
                        <option selected disabled value="">
                            {{ translations["Choose a tenant"] }}
                        </option>
                        <option
                            v-for="tenant in tenants"
                            :key="tenant.id"
                            :value="tenant.id"
                        >
                            {{ tenant.name }}
                        </option>
                    </select>
                    <div
                        class="text-red-600 text-sm tracking-wide mt-1"
                        :class="{ 'text-left': isLTR, 'text-right': !isLTR }"
                        v-if="'tenant' in errors"
                    >
                        {{ errors.tenant[0] }}
                    </div>
                </div>

                <button
                    class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium"
                    @click.prevent="getData"
                >
                    {{ translations["Get Data"] }}
                </button>
            </div>
        </div>

        <div
            v-if="Object.keys(tenant).length"
            class="mt-10 pt-10 border-t-2 border-white"
        >
            <div class="flex flex-col justify-center items-center md:px-4">
                <div class="md:flex md:items-start w-full">
                    <div class="bg-white w-full rounded-lg shadow-xl">
                        <div
                            class="p-4 border-b flex justify-between items-center"
                        >
                            <h2 class="text-2xl flex items-center">
                                <span>{{
                                    translations["Tenant Information"]
                                }}</span>
                            </h2>
                        </div>
                        <div>
                            <div
                                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                            >
                                <p class="text-gray-600">
                                    {{ translations["Name"] }}
                                </p>
                                <p>
                                    {{ tenant.name }}
                                </p>
                            </div>
                            <div
                                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                            >
                                <p class="text-gray-600">
                                    {{ translations["Email Address"] }}
                                </p>
                                <p>
                                    {{ tenant.email }}
                                </p>
                            </div>
                            <div
                                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                            >
                                <p class="text-gray-600">
                                    {{ translations["Phone Number"] }}
                                </p>
                                <p>
                                    {{ tenant.phone }}
                                </p>
                            </div>
                            <div
                                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                            >
                                <p class="text-gray-600">
                                    {{ translations["Birthday"] }}
                                </p>
                                <p>
                                    {{ tenant.birthday }}
                                </p>
                            </div>
                            <div
                                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                            >
                                <p class="text-gray-600">
                                    {{ translations["Nationality"] }}
                                </p>
                                <p>
                                    {{ tenant.nationality }}
                                </p>
                            </div>
                            <div
                                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                            >
                                <p class="text-gray-600">
                                    {{ translations["National Card Number"] }}
                                </p>
                                <p>
                                    {{ tenant.national_card_no }}
                                </p>
                            </div>
                            <div
                                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                            >
                                <p class="text-gray-600">
                                    {{ translations["Passport Number"] }}
                                </p>
                                <p>
                                    {{ tenant.passport_no }}
                                </p>
                            </div>
                            <div
                                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                            >
                                <p class="text-gray-600">
                                    {{ translations["Marital Status"] }}
                                </p>
                                <p>
                                    {{ tenant.marital_status }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white w-full rounded-lg shadow-xl mt-5 md:mt-0"
                        :class="{ 'md:ml-5': isLTR, 'md:mr-5': !isLTR }"
                    >
                        <div
                            class="p-4 border-b flex justify-between items-center"
                        >
                            <h2 class="text-2xl">
                                {{ translations["Contracts"] }} ({{
                                    tenant.contracts.length
                                }})
                            </h2>
                        </div>
                        <div class="p-4">
                            <div
                                class="my-5 w-full block"
                                v-for="contract in tenant.contracts"
                                :key="contract.id"
                            >
                                <div
                                    class="w-full rounded-lg shadow-lg p-4 hover:bg-gray-100 transition duration-300 ease-in-out"
                                >
                                    <h3
                                        class="font-semibold text-lg tracking-wide flex items-center"
                                    >
                                        <span
                                            >{{ contract.start_date }} -
                                            {{ contract.end_date }}</span
                                        >
                                        <span
                                            class="px-2 py-1 text-center inline-flex text-xs leading-5 font-semibold rounded-full text-white"
                                            :class="{
                                                'bg-green-600': contract.valid,
                                                'bg-red-600': !contract.valid,
                                                'ml-2': isLTR,
                                                'mr-2': !isLTR
                                            }"
                                        >
                                            <span
                                                class="font-bold"
                                                v-if="!contract.valid"
                                            >
                                                {{ translations["Ended"] }}
                                            </span>
                                            <span class="font-bold" v-else>
                                                {{ contract.title }}
                                            </span>
                                        </span>
                                    </h3>
                                    <div class="mt-3 mx-3">
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold"
                                                >{{
                                                    translations["Rent Amount"]
                                                }}:</span
                                            >
                                            {{ contract.rent_amount }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold"
                                                >{{
                                                    translations["Duration"]
                                                }}:</span
                                            >
                                            {{ contract.duration }}
                                        </p>

                                        <br />

                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">
                                                {{ translations["Address"] }}:
                                            </span>
                                            {{ contract.address }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">
                                                {{
                                                    translations[
                                                        "Building Number"
                                                    ]
                                                }}:
                                            </span>
                                            {{ contract.building_no }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">
                                                {{ translations["Floor"] }}:
                                            </span>
                                            {{ contract.floor }}
                                        </p>
                                        <p class="text-gray-500 my-1">
                                            <span class="font-bold">
                                                {{ translations["Apartment"] }}:
                                            </span>
                                            {{ contract.apartment }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="font-bold text-xl bg-red-600 text-white px-4 py-2 w-64 text-center rounded-lg"
                                v-if="!Object.keys(tenant.contracts).length"
                            >
                                {{ translations["Nothing found"] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white w-full rounded-lg shadow-xl mt-5">
                    <div class="p-4 border-b flex justify-between items-center">
                        <h2 class="text-2xl">
                            {{ translations["Dues"] }} ({{
                                tenant.unpaid_dues_count
                            }})
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="mb-5 w-full">
                            <div
                                class="w-full rounded-lg p-4 border border-gray-400"
                            >
                                <h3
                                    class="tracking-wide flex items-center justify-between"
                                >
                                    <div class="flex items-center">
                                        <span class="text-2xl font-bold"
                                            >{{
                                                translations["Summary"]
                                            }}:</span
                                        >
                                    </div>
                                </h3>
                                <div
                                    class="mt-3 mx-3 text-lg md:text-xl text-center"
                                >
                                    <div
                                        class="flex items-center justify-evenly flex-col md:flex-row"
                                    >
                                        <div>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Total Unpaid Dues"
                                                        ]
                                                    }}:</span
                                                >
                                                {{
                                                    tenant.total_unpaid_dues_amount
                                                }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Total Paid Dues"
                                                        ]
                                                    }}:</span
                                                >
                                                {{
                                                    tenant.total_paid_dues_amount
                                                }}
                                            </p>
                                            <br />
                                        </div>
                                        <div>
                                            <p
                                                class="text-gray-500 my-1"
                                                v-for="due_category in tenant.dues_by_category"
                                                :key="due_category.id"
                                            >
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Unpaid Dues"
                                                        ]
                                                    }}
                                                    ({{
                                                        due_category.name
                                                    }}):</span
                                                >
                                                {{ due_category.total_unpaid }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="font-bold text-2xl text-gray-600">
                                {{ translations["Unpaid Dues"] }}:
                            </div>
                            <div :class="{ 'ml-3': isLTR, 'mr-3': !isLTR }">
                                <div
                                    class="my-5 w-full"
                                    v-for="due in tenant.dues.unpaid"
                                    :key="due.id"
                                >
                                    <div
                                        class="w-full rounded-lg shadow-lg p-4 hover:bg-gray-100 transition duration-300 ease-in-out"
                                    >
                                        <h3
                                            class="font-semibold text-lg tracking-wide flex items-center justify-center flex-col md:flex-row md:justify-between"
                                        >
                                            <div class="flex items-center">
                                                <span
                                                    class="text-xl font-bold"
                                                    >{{ due.amount_left }}</span
                                                >
                                                <span
                                                    class="px-2 py-1 text-center inline-flex text-xs leading-5 font-semibold rounded-full text-white"
                                                    :class="{
                                                        'bg-green-600':
                                                            due.status,
                                                        'bg-red-600': !due.status,
                                                        'ml-2': isLTR,
                                                        'mr-2': !isLTR
                                                    }"
                                                    >{{ due.status_name }}</span
                                                >
                                            </div>
                                        </h3>
                                        <div class="mt-3 mx-3">
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Amount Left"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.amount_left }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Paid Amount"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.paid_amount }}
                                            </p>

                                            <br />

                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations["Amount"]
                                                    }}:</span
                                                >
                                                {{ due.amount }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Discount"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.discount }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold">
                                                    {{
                                                        translations[
                                                            "Amount After Discount"
                                                        ]
                                                    }}:
                                                </span>
                                                {{ due.amount_with_discount }}
                                            </p>

                                            <br />

                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Category"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.category }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations["Note"]
                                                    }}:</span
                                                >
                                                {{ due.note }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Created At"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.created_at }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="font-bold mt-5 text-xl bg-red-600 text-white px-4 py-2 w-64 text-center rounded-lg"
                                    v-if="
                                        !Object.keys(tenant.dues.unpaid).length
                                    "
                                >
                                    {{ translations["Nothing found"] }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-10">
                            <div class="font-bold text-2xl text-gray-600">
                                {{ translations["Paid Dues"] }}:
                            </div>
                            <div :class="{ 'ml-3': isLTR, 'mr-3': !isLTR }">
                                <div
                                    class="my-5 w-full"
                                    v-for="due in tenant.dues.paid"
                                    :key="due.id"
                                >
                                    <div
                                        class="w-full rounded-lg shadow-lg p-4 hover:bg-gray-100 transition duration-300 ease-in-out"
                                    >
                                        <h3
                                            class="font-semibold text-lg tracking-wide flex items-center justify-center flex-col md:flex-row md:justify-between"
                                        >
                                            <div class="flex items-center">
                                                <span
                                                    class="text-xl font-bold"
                                                    >{{ due.amount_left }}</span
                                                >
                                                <span
                                                    class="px-2 py-1 text-center inline-flex text-xs leading-5 font-semibold rounded-full text-white"
                                                    :class="{
                                                        'bg-green-600':
                                                            due.status,
                                                        'bg-red-600': !due.status,
                                                        'ml-2': isLTR,
                                                        'mr-2': !isLTR
                                                    }"
                                                    >{{ due.status_name }}</span
                                                >
                                            </div>
                                        </h3>
                                        <div class="mt-3 mx-3">
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Amount Left"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.amount_left }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Paid Amount"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.paid_amount }}
                                            </p>

                                            <br />

                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations["Amount"]
                                                    }}:</span
                                                >
                                                {{ due.amount }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Discount"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.discount }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold">
                                                    {{
                                                        translations[
                                                            "Amount After Discount"
                                                        ]
                                                    }}:
                                                </span>
                                                {{ due.amount_with_discount }}
                                            </p>

                                            <br />

                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Category"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.category }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations["Note"]
                                                    }}:</span
                                                >
                                                {{ due.note }}
                                            </p>
                                            <p class="text-gray-500 my-1">
                                                <span class="font-bold"
                                                    >{{
                                                        translations[
                                                            "Created At"
                                                        ]
                                                    }}:</span
                                                >
                                                {{ due.created_at }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="font-bold mt-5 text-xl bg-red-600 text-white px-4 py-2 w-64 text-center rounded-lg"
                                    v-if="!Object.keys(tenant.dues.paid).length"
                                >
                                    {{ translations["Nothing found"] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["lang"],

    data() {
        return {
            loader: true,
            loading: false,
            translations: {},
            errors: {},

            tenants: {},
            tenantId: "",
            tenant: {}
        };
    },

    computed: {
        isLTR: () => document.dir == "ltr"
    },

    created() {
        this.getTranslations().then(() => this.getTenants());
    },

    methods: {
        toggleProcessing(status) {
            if (status) {
                if (this.loading) return false;
                this.loading = true;
                this.errors = {};
            } else {
                this.loading = false;
            }
            return true;
        },

        getTranslations() {
            this.loader = true;
            if (!this.toggleProcessing(true)) return false;

            return axios
                .post("/api/translations", {
                    lang: this.lang
                })
                .then(res => {
                    if (res.data.status) {
                        this.translations = res.data.data;
                    } else {
                        notyf.error(res.data.error);
                    }
                })
                .catch(error => {
                    if ("errors" in error.response.data) {
                        this.errors = error.response.data.errors;
                    } else {
                        notyf.error(
                            error.response.data.error ??
                                "There has been error. Please try again."
                        );
                    }
                })
                .finally(() => {
                    this.toggleProcessing(false);
                    this.loader = false;
                });
        },

        getTenants() {
            this.loader = true;
            if (!this.toggleProcessing(true)) return false;

            axios
                .post("/api/tenants", {
                    lang: this.lang
                })
                .then(res => {
                    if (res.data.status) {
                        this.tenants = res.data.data;
                    } else {
                        notyf.error(res.data.error);
                    }
                })
                .catch(error => {
                    if ("errors" in error.response.data) {
                        this.errors = error.response.data.errors;
                    } else {
                        notyf.error(
                            error.response.data.error ??
                                "There has been error. Please try again."
                        );
                    }
                })
                .finally(() => {
                    this.toggleProcessing(false);
                    this.loader = false;
                });
        },

        getData(e) {
            disableBtn(e.target, true);
            this.tenant = {};
            if (!this.toggleProcessing(true)) return false;

            axios
                .post("/api/tenant", {
                    lang: this.lang,
                    tenant: this.tenantId
                })
                .then(res => {
                    if (res.data.status) {
                        this.tenant = res.data.data;
                    } else {
                        notyf.error(res.data.error);
                    }
                })
                .catch(error => {
                    if ("errors" in error.response.data) {
                        this.errors = error.response.data.errors;
                    } else {
                        notyf.error(
                            error.response.data.error ??
                                "There has been error. Please try again."
                        );
                    }
                })
                .finally(() => {
                    enableBtn(e.target);
                    this.toggleProcessing(false);
                });
        }
    }
};
</script>
