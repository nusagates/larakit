<template>
  <v-layout>
    <v-app-bar class="px-md-4" color="surface-variant" flat>
      <template #prepend>
        <v-app-bar-nav-icon
            v-if="$vuetify.display.smAndDown"
            @click="drawer = !drawer"
        />
      </template>

      <v-img
          class="me-sm-8"
          max-width="40"
          src="https://cdn.vuetifyjs.com/docs/images/logos/v.svg"
      />

      <template v-if="$vuetify.display.mdAndUp">
        <v-btn v-for="item in items"
               class="me-2 text-none"
               slim
               @click="go(item.slug)"
               :active="$page.url===item.slug"
               :text="item.text"
        />
        <v-btn v-if="$page.props.auth.user.organization_id!==null" v-for="item in subItems"
               class="me-2 text-none"
               slim
               @click="go(item.slug)"
               :active="$page.url===item.slug"
               :text="item.text"
        />
      </template>

      <v-spacer/>

      <template #append>
        <v-btn
            class="ms-1 opacity-60"
            icon="mdi-bell-outline"
        />

        <v-btn class="ms-1" icon>
          <v-avatar :image="$page.props.auth.user.avatar"/>

          <v-menu activator="parent" origin="top">
            <v-list>
              <v-list-item @click="go('/profile')" link title="Update profile"/>

              <v-list-item @click="router.post('/logout')" link title="Sign out"/>
            </v-list>
          </v-menu>
        </v-btn>
      </template>
    </v-app-bar>

    <v-navigation-drawer
        v-if="$vuetify.display.smAndDown"
        v-model="drawer"
        location="top"
        temporary
        width="355"
    >
      <v-list class="py-0" slim>
        <v-list-item link prepend-icon="mdi-home-outline" title="Dashboard"/>

        <v-list-group
            prepend-icon="mdi-account-multiple-outline"
            title="Customers"
        >
          <template #activator="{ props: activatorProps }">
            <v-list-item v-bind="activatorProps"/>
          </template>

          <v-list-item
              link
              prepend-icon="mdi-account-plus-outline"
              title="Create New"
          />

          <v-list-group prepend-icon="mdi-magnify" title="Search">
            <template #activator="{ props: activatorProps }">
              <v-list-item v-bind="activatorProps"/>
            </template>

            <v-list-item
                link
                prepend-icon="mdi-account-outline"
                title="By Name"
            />

            <v-list-item
                link
                prepend-icon="mdi-email-outline"
                title="By Email"
            />

            <v-list-item
                link
                prepend-icon="mdi-phone-outline"
                title="By Phone"
            />
          </v-list-group>
        </v-list-group>

        <v-list-item link prepend-icon="mdi-calendar" title="Calendar"/>

        <v-list-item link prepend-icon="mdi-poll" title="Analytics"/>

        <v-divider/>

        <v-list-item link prepend-icon="mdi-inbox-outline" title="Inbox"/>

        <v-list-item
            link
            prepend-icon="mdi-bell-outline"
            title="Notifications"
        />

        <v-divider/>

        <v-list-item
            lines="two"
            link
            :prepend-avatar="$page.props.auth.user.avatar"
            :subtitle="$page.props.auth.user.email"
            :title="$page.props.auth.user.name"
        />
      </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-toolbar v-if="title" color="surface" elevation="1" height="84">
        <template #title>
          <h2 class="text-h4 font-weight-bold">{{ title }}</h2>
        </template>
      </v-toolbar>

      <div class="pa-4">
        <slot/>
      </div>
    </v-main>
  </v-layout>
</template>

<script setup>
import {shallowRef} from 'vue'
import {router, usePage} from "@inertiajs/vue3";
import {go} from "@/funcs.js";

const drawer = shallowRef(false)
const props = defineProps(['title'])
const page = usePage()
const items = [
  {
    text: 'Dashboard',
    slug: '/dashboard',
  },
  {
    text: 'Organizations',
    slug: '/organization',
  },
]
const subItems = [
  {
    text: 'Contact',
    slug: '/contact',
  },
  {
    text: 'Product',
    slug: '/product',
  },
  {
    text: 'Invoice',
    slug: '/invoice',
  },
]
</script>

<style scoped>

</style>