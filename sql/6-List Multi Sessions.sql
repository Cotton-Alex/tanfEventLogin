/* LIST MULTIPLE SESSION EVENTS */
SELECT TOP 1000 [MultipleSessionEventSessionID]
      ,[TANFMultipleSessionEventID]
      ,[StartDate]
  FROM [beta_torresmartinez].[TANFMultipleSessionEventModule].[MultipleSessionEventSession]
  ORDER BY [MultipleSessionEventSessionID] DESC