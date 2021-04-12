create view indicator_measures_aggregate as
  select period, indicatorid, description, type,
         case type when 'Percentage' then avg(indicator_measures.value)
                   when 'Calculated' then avg(indicator_measures.value)
                   else total(indicator_measures.value) end as value,
        total(indicator_measures.staff_in_group) as staff_in_group,
         total(indicator_measures.completions) as completions
  from indicator_measures inner join indicators on indicator_measures.indicatorid = indicators.id where category = 'standard'
                                                                                                    and indicator_measures.committed = 1
  group by period, indicatorid

