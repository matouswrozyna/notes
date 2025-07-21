export type PriorityValue = 1 | 2 | 3

export interface PriorityOption {
  label: string
  value: PriorityValue
  color: string
}

export const PRIORITY_OPTIONS: PriorityOption[] = [
  { label: 'Low', value: 1, color: 'green' },
  { label: 'Medium', value: 2, color: 'orange' },
  { label: 'High', value: 3, color: 'red' },
]

export const PRIORITY_MAP = Object.fromEntries(PRIORITY_OPTIONS.map(({ value, ...rest }) => [value, rest])) as Record<
  PriorityValue,
  Omit<PriorityOption, 'value'>
>
