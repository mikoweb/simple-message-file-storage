export default class MessageDto {
  constructor(
    public readonly id: string,
    public readonly message: string,
    public readonly createdAt: string
  ) {}

  public static fromRawObject(data): this {
    return new MessageDto(
      data.id,
      data.message,
      data.createdAt
    );
  }
}
