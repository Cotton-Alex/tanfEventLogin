/* LIST CLIENT INFO */
SELECT H.[HouseholdID]
, S.[PersonID]
, P.[FirstName]
, P.[LastName]
, S.[SSN]
FROM [beta_torresmartinez].[PersonModule].[Person] P
JOIN [beta_torresmartinez].[PersonSSNModule].[Person] S
ON P.[PersonID] = S.[PersonID]
JOIN [beta_torresmartinez].[HouseholdModule].[HouseholdMember] H
ON P.[PersonID] = H.[PersonID]
ORDER BY [LastName], [SSN]