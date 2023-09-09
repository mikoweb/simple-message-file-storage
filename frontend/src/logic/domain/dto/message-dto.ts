import { DateTime } from 'luxon';
import DateFormatter from "@/logic/application/date/date-formatter";

export default class MessageDto {
  constructor(
    public readonly id: string,
    public readonly message: string,
    public readonly createdAt: DateTime
  ) {}

  public get formattedCreatedAt(): string {
    return DateFormatter.formatToDateTime(this.createdAt);
  }

  public static fromRawObject(data): this {
    return new MessageDto(
      data.id,
      data.message,
      DateTime.fromISO(data.createdAt),
    );
  }
}
