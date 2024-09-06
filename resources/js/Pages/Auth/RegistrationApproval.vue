<template>
  <Head title="Registration Approval"/>
  <AuthenticatedLayout>
    <v-btn :loading="requestState" :disabled="requestState" @click="sendRequest">Request Approval</v-btn>
    <v-dialog v-model="reqDialog" max-width="500">
      <v-card>
        <v-toolbar density="compact" title="Confirmation">
          <v-spacer/>
          <v-toolbar-items>
            <v-btn @click="reqDialog=false" icon>
              <v-icon icon="mdi-close"/>
            </v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <v-card-text>
          Konten
        </v-card-text>
        <v-card-actions>
          <v-btn @click="reqDialog=false">Batal</v-btn>
          <v-spacer/>
          <v-btn @click="approvalResult" color="success" variant="flat">Simpan</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {router, usePage} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";
import {toast} from "vue3-toastify";

const requestState = ref(false)
const reqDialog = ref(false)
const sendRequest = () => {
  requestState.value = true
  router.post('/registration-approval', {}, {
    onSuccess: (r) => {
      requestState.value = false
      console.log('Request sent');
    },
    onError: (r) => {
      requestState.value = false
      console.log('Request failed');
    }, finally: () => {
      requestState.value = false
    }
  });
}
const page = usePage()
const user = page.props.auth.user
onMounted(() => {
  Echo.private('management')
      .listen('RegistrationApprovalEvent', (e) => {
        console.log(user?.id, e)
        if (user?.id === e.user?.id && e.data.status === 'requested') {
          reqDialog.value = true
        }else if(user?.id === e.user?.id && e.data.status === 'approved'){
          toast.success('Registration approved')
        }
      });
})

const approvalResult = () => {
  reqDialog.value = false
  router.post('/registration-approval-status', {}, {
    onSuccess: (r) => {
      console.log('Request sent');
    },
    onError: (r) => {
      console.log('Request failed');
    }
  });
}
</script>

<style scoped>

</style>