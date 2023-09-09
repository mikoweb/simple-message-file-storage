import {inject, singleton} from 'tsyringe';
import Client from '@/logic/infrastructure/api/client';
import MessageIdDto from '@/logic/domain/dto/message-id-dto';
import MessageFormDto from '@/logic/domain/dto/message-form-dto';

@singleton()
export default class MessagePersistence {
  constructor(
    @inject(Client) private readonly client: Client
  ) {}

  public async saveForm(form: MessageFormDto): Promise<MessageIdDto> {
    const resposne = await this.client.method.post('message/', form);

    return new MessageIdDto(resposne.data.id);
  }
}
