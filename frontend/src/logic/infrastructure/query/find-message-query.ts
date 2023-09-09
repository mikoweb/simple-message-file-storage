import {inject, singleton} from 'tsyringe';
import Client from "@/logic/infrastructure/api/client";
import MessageDto from "@/logic/domain/dto/message-dto";

@singleton()
export default class FindMessageQuery {
  constructor(
    @inject(Client) private readonly client: Client
  ) {}

  public async find(id: string): Promise<MessageDto | null> {
    let resposne;

    try {
      resposne = await this.client.method.get(`message/${id}`);
    } catch (error) {
      return null;
    }

    return MessageDto.fromRawObject(resposne.data);
  }
}
