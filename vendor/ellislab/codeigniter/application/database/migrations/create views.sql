create view indicator_measures_aggregate as
  select period, indicatorid, description, type, case type when 'Percentage' then avg(indicator_measures.value) else total(indicator_measures.value) end as value
  from indicator_measures inner join indicators on indicator_measures.indicatorid = indicators.id where category = 'standard' group by period, indicatorid

