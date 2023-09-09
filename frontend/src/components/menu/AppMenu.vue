<style src="./style.scss" lang="scss" />
<template>
  <ion-menu content-id="main-content" type="overlay">
    <ion-content>
      <ion-list id="inbox-list">
        <ion-list-header>Menu</ion-list-header>
        <ion-note></ion-note>

        <ion-menu-toggle :auto-hide="false" v-for="(p, i) in appPages" :key="i">
          <ion-item @click="selectedIndex = i" router-direction="root" :router-link="p.url" lines="none" :detail="false" class="hydrated" :class="{ selected: selectedIndex === i }">
            <ion-icon aria-hidden="true" slot="start" :ios="p.iosIcon" :md="p.mdIcon"></ion-icon>
            <ion-label>{{ p.title }}</ion-label>
          </ion-item>
        </ion-menu-toggle>
      </ion-list>
    </ion-content>
  </ion-menu>
</template>

<script setup lang="ts">
import {
  IonContent,
  IonIcon,
  IonItem,
  IonLabel,
  IonList,
  IonListHeader,
  IonMenu,
  IonMenuToggle,
  IonNote,
} from '@ionic/vue';
import { ref } from 'vue';
import {
  mailOutline,
  mailSharp,
} from 'ionicons/icons';

const selectedIndex = ref(0);
const appPages = [
  {
    title: 'Messages',
    url: '/page/messages',
    iosIcon: mailOutline,
    mdIcon: mailSharp,
  }
];

const path = window.location.pathname.split('folder/')[1];

if (path !== undefined) {
  selectedIndex.value = appPages.findIndex((page) => page.title.toLowerCase() === path.toLowerCase());
}
</script>
