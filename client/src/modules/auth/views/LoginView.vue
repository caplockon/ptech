<script setup>
import {ref} from "vue";
import IconLocked from "@/components/icons/IconLocked.vue";
import {validateForm} from "@/modules/auth/validations/loginForm";
import {usePTechAuth} from "@/services/ptech";
import {useAuthStore} from "@/stores/auth";
import {useRouter} from "vue-router";

const router = useRouter();
const email = ref('admin@gmail.com'), password = ref('123456'), errors = ref({});
const authError = ref('');

/**
 * Fetch user information
 * @returns {Promise<*>}
 */
async function fetchUserInfo() {
    const res = await usePTechAuth().me();
    useAuthStore().setUser(res.data.data);
    return res;
}

function sendLogin(ctx) {
    // Clean up all error before sending request
    errors.value = {}; authError.value = '';
    usePTechAuth().login(ctx).then(function (res) {
        const accessToken = res.data;
        accessToken.created_at = new Date();
        // Store access token for using later
        useAuthStore().setToken(accessToken);
    }).then(fetchUserInfo).then(function () {
        // Fetch user information and redirect home page
        router.push({name: 'home'})
    }).catch(function (e) {
        // Throw a "NotKnown" error verbiage key
        authError.value = "LoginView.ErrorNotKnown"
    });
}

function submitLogin(e) {
    e.preventDefault();
    validateForm({email, password}).then(sendLogin).catch(e => errors.value = e);
}

</script>

<template>
    <div class="flex flex-col bg-gray-100 items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <a href="/" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
        <img src="https://flowbite.com/application-ui/demo/images/logo.svg" class="mr-4 h-11" alt="FlowBite Logo">
        <span>PhucTech</span>
        </a>
        <!-- Card -->
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Sign in to platform
            </h2>
            <form class="mt-8 space-y-6" action="#" @submit.prevent="submitLogin">
                <div>
                    <label for="email-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{$t('LoginView.EmailLabel')}}</label>
                    <input id="email-address" v-model="email" name="email" type="email"
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           :placeholder="$t('LoginView.EmailLabel')">
                    <span v-if="errors.email" class="text-red-500">{{$t(errors.email)}}</span>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{$t('LoginView.EmailLabel')}}</label>
                    <input id="password" v-model="password" name="email" type="password"
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           :placeholder="$t('LoginView.PasswordLabel')">
                    <span v-if="errors.password" class="text-red-500">{{$t(errors.password)}}</span>
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="remember" class="font-medium text-gray-900 dark:text-white">{{$t('LoginView.RememberMeLabel')}}</label>
                    </div>
                    <a href="#" class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">{{$t('LoginView.ForgetPassword')}}</a>
                </div>
                <button type="submit" class="w-full bg-blue-600 px-5 py-3 text-base font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    {{$t('LoginView.SignInButtonLabel')}}
                </button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Not registered? <a class="text-primary-700 hover:underline dark:text-primary-500">Create account</a>
                </div>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>