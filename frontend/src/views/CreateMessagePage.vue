<template>
  <app-main title="Create Message">
    <div class="ion-padding">
      <form @submit.prevent="_onSubmit">
        <ion-textarea
                v-model="formData.message"
                label="Message:"
                placeholder="Type something here"
                auto-grow
                required>
        </ion-textarea>
        <div class="ion-padding-top">
          <ion-button type="submit" fill="outline">Submit</ion-button>
        </div>
      </form>
    </div>
  </app-main>
</template>

<script setup lang="ts">
import AppMain from "@/components/main/AppMain.vue";
import { IonTextarea, IonButton } from '@ionic/vue';
</script>

<script lang="ts">
import { defineComponent } from 'vue';
import { container } from 'tsyringe';
import UiMessageService from '@/logic/application/ui-message/ui-message-service';
import MessageFormDto from '@/logic/domain/dto/message-form-dto';
import MessagePersistence from '@/logic/infrastructure/persistence/message-persistence';

export default defineComponent({
  data() {
    return {
      formData: {} as MessageFormDto,
    }
  },
  methods: {
    resetForm(form: HTMLFormElement): void {
      form.reset();
      form.querySelectorAll('ion-textarea, ion-input').forEach((input: any) => {input.value = ''});
    },
    async _onSubmit(event: Event): void {
      this.resetForm(event.target as HTMLFormElement);
      const uiMessageService: UiMessageService = container.resolve(UiMessageService);

      try {
        const messageId = await container.resolve(MessagePersistence).saveForm(this.formData);
        await uiMessageService.createSuccess({message: `Message created! Message id: ${messageId.id}`});
      } catch (error) {
        await uiMessageService.createError({message: 'Save fail!'});
      }
    }
  }
});
</script>
